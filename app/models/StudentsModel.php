<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{
    protected $table = 'students';
    protected $primary_key = 'id';

    // sa loob ng class StudentsModel extends Model
    public function find_by_email_or_username($identifier)
{
    // I-check na only active (not soft-deleted) users
    $sql = "SELECT * FROM {$this->table} 
            WHERE (email = ? OR username = ?) 
            AND {$this->soft_delete_column} IS NULL 
            LIMIT 1";
    $result = $this->db->raw($sql, [$identifier, $identifier]);
    return $result->fetch(PDO::FETCH_ASSOC);
}


    public function __construct()
    {
        parent::__construct();
    }

    protected $has_soft_delete = true;
    protected $soft_delete_column = 'deleted_at';

    /* =========================
     * ACTIVE RECORDS
     * ========================= */
    public function count_all_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_records_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $sql .= " ORDER BY id ASC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
     * DELETED RECORDS
     * ========================= */
    public function count_deleted_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_deleted_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];

        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $sql .= " ORDER BY id DESC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_deleted_records()
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL ORDER BY id DESC";
        return $this->db->raw($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function soft_delete($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NOW() WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

    public function restore($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NULL WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

    public function hard_delete($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "DELETE FROM {$this->table} WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

     function handle_profile_upload($fileInputName = 'profile_picture')
    {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $file = $_FILES[$fileInputName];
        if ($file['error'] !== UPLOAD_ERR_OK) return null;

        $allowed_ext = ['jpg','jpeg','png','gif'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext)) return null;

        if ($file['size'] > 2 * 1024 * 1024) return null;

        $newname = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;

        // **FIXED UPLOAD PATH**
        $destFolder = $_SERVER['DOCUMENT_ROOT'] . '/LavaLustko/app/public/uploads/profile_pictures/';
        if (!is_dir($destFolder)) mkdir($destFolder, 0777, true);

        $destPath = $destFolder . $newname;

        if (move_uploaded_file($file['tmp_name'], $destPath)) return $newname;

        return null;
    }

    // Sa StudentsModel

public function register_user($post_data, $file_input = 'profile_picture') {
    $data = [
        'email' => trim($post_data['email']),
        'username' => trim($post_data['username']),
        'password' => password_hash($post_data['password'], PASSWORD_DEFAULT),
        'role' => $post_data['role'] ?? 'student',
        'profile_picture' => $this->handle_profile_upload($file_input),
        'created_at' => date('Y-m-d H:i:s')
    ];

    return $this->insert($data);
}


public function login_user($identifier, $password) {
    $user = $this->find_by_email_or_username($identifier);

    if ($user && password_verify($password, $user['password'])) {
        return $user; // just return user data
    }

    return false;
}

public function get_profile($user_id) {
    return $this->find($user_id);
}

}