<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('pagination');
        $this->call->library('session');
        $this->call->library('form_validation');
        $this->call->library('upload');

        // Pagination theme
        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav' => 'pagination-nav',
            'ul' => 'pagination-list',
            'li' => 'pagination-item',
            'a' => 'pagination-link',
            'active' => 'active'
        ]);
    }

    /*** FETCH USERS WITH PAGINATION ***/
    public function get_all($page = 1)
    {
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) $per_page = 10;

        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $show_deleted = isset($_GET['show']) && $_GET['show'] === 'deleted';

        $offset = ($page - 1) * $per_page;
        $limit_clause = "LIMIT {$offset}, {$per_page}";

        if ($show_deleted) {
            $total_rows = $this->StudentsModel->count_deleted_records($search);
            $records = $this->StudentsModel->get_deleted_with_pagination($limit_clause, $search);
            $base_url = '/users/get-all?show=deleted';
        } else {
            $total_rows = $this->StudentsModel->count_all_records($search);
            $records = $this->StudentsModel->get_records_with_pagination($limit_clause, $search);
            $base_url = '/users/get-all';
        }

        $pagination_data = $this->pagination->initialize(
            $total_rows,
            $per_page,
            $page,
            $base_url,
            5
        );

        $data = [
            'records'          => $records,
            'total_records'    => $total_rows,
            'pagination_data'  => $pagination_data,
            'pagination_links' => $this->pagination->paginate(),
            'search'           => $search,
            'show_deleted'     => $show_deleted,
            'success'          => $this->session->flashdata('success'),
            'error'            => $this->session->flashdata('error')
        ];

        $this->call->view('ui/get_all', $data);
    }

    public function deleted($page = 1)
    {
        $_GET['show'] = 'deleted';
        $this->get_all($page);
    }

    /*** CREATE USER ***/
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            if (empty($password)) {
                $this->session->set_flashdata('error', 'Password is required.');
                redirect('/users/create');
                return;
            }

            // Handle file upload using Lavalust Upload library
            $profile_picture = null;
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $this->upload->file = $_FILES['profile_picture'];
                $this->upload
                    ->set_dir('public/uploads/')
                    ->max_size(5)
                    ->allowed_extensions(['jpg', 'jpeg', 'png', 'gif'])
                    ->allowed_mimes(['image/jpeg', 'image/png', 'image/gif'])
                    ->is_image()
                    ->encrypt_name();

                if ($this->upload->do_upload()) {
                    $profile_picture = $this->upload->get_filename();
                } else {
                    $this->session->set_flashdata('error', implode('<br>', $this->upload->get_errors()));
                    redirect('/users/create');
                    return;
                }
            }

            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $_POST['role'] ?? 'student',
                'profile_picture' => $profile_picture,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->StudentsModel->insert($data);
            $this->session->set_flashdata('success', 'User created successfully!');
            redirect('users/get-all');
        }

        $data = [
            'success' => $this->session->flashdata('success'),
            'error'   => $this->session->flashdata('error')
        ];
        $this->call->view('ui/create', $data);
    }

    /*** UPDATE USER ***/
    public function update($id)
    {
        $user = $this->StudentsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => trim($_POST['email'] ?? $user['email']),
                'username' => trim($_POST['username'] ?? $user['username']),
                'role' => $_POST['role'] ?? $user['role'],
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            // Upload new profile picture (if any)
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $this->upload->file = $_FILES['profile_picture'];
                $this->upload
                    ->set_dir('public/uploads/')
                    ->max_size(5)
                    ->allowed_extensions(['jpg', 'jpeg', 'png', 'gif'])
                    ->allowed_mimes(['image/jpeg', 'image/png', 'image/gif'])
                    ->is_image()
                    ->encrypt_name();

                if ($this->upload->do_upload()) {
                    $data['profile_picture'] = $this->upload->get_filename();
                } else {
                    $this->session->set_flashdata('error', implode('<br>', $this->upload->get_errors()));
                    redirect("/users/update/{$id}");
                    return;
                }
            }

            $this->StudentsModel->update($id, $data);
            $this->session->set_flashdata('success', 'Updated successfully!');
            redirect('/users/get-all');
        }

        $data = [
            'user' => $user,
            'success' => $this->session->flashdata('success'),
            'error'   => $this->session->flashdata('error')
        ];

        $this->call->view('ui/update', $data);
    }

    /*** SOFT/HARD DELETE & RESTORE ***/
    public function delete($id)
    {
        $this->StudentsModel->soft_delete($id);
        $this->session->set_flashdata('success', 'User archived successfully!');
        redirect('/users/get-all');
    }

    public function hard_delete($id)
    {
        $this->StudentsModel->hard_delete($id);
        $this->session->set_flashdata('success', 'User deleted permanently!');
        redirect('users/get-all?show=deleted');
    }

    public function restore($id)
    {
        $this->StudentsModel->restore($id);
        $this->session->set_flashdata('success', 'User restored successfully!');
        redirect('users/get-all?show=deleted');
    }

    /*** REGISTER (Frontend) ***/
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation
                ->name('email')->required('Email is required')->valid_email('Invalid email')
                ->name('username')->required('Username is required')->min_length(3)
                ->name('password')->required('Password is required')->min_length(6);

            $errors = $this->form_validation->run() == FALSE ? $this->form_validation->errors() : '';

            // Validate file
            if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] === UPLOAD_ERR_NO_FILE) {
                $errors .= '<p>Profile picture is required.</p>';
            }

            if (!empty($errors)) {
                $data = ['error' => $errors];
                $this->call->view('auth/register', $data);
                return;
            }

            // Upload image
            $this->upload->file = $_FILES['profile_picture'];
            $this->upload
                ->set_dir('public/uploads/')
                ->max_size(5)
                ->allowed_extensions(['jpg', 'jpeg', 'png'])
                ->allowed_mimes(['image/jpeg', 'image/png'])
                ->is_image()
                ->encrypt_name();

            if (!$this->upload->do_upload()) {
                $this->session->set_flashdata('error', implode('<br>', $this->upload->get_errors()));
                redirect('/register');
                return;
            }

            $profile_picture = $this->upload->get_filename();

            $this->StudentsModel->register_user($_POST, $profile_picture);
            $this->session->set_flashdata('success', 'Registration successful! Please login.');
            redirect('/login');
        }

        $data = [
    'success' => $this->session->flashdata('success') ?? null,
    'error'   => $this->session->flashdata('error') ?? null
];
$this->call->view('auth/register', $data);

    }

    /*** LOGIN / LOGOUT / PROFILE ***/
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation
                ->name('username_or_email')->required('Username or Email is required')
                ->name('password')->required('Password is required');

            if ($this->form_validation->run() == FALSE) {
                $data = ['error' => $this->form_validation->errors()];
                $this->call->view('auth/login', $data);
                return;
            }

            $user = $this->StudentsModel->login_user($_POST['username_or_email'], $_POST['password']);

            if ($user) {
                $this->session->set_userdata([
                    'user_id'   => $user['id'],
                    'role'      => $user['role'],
                    'username'  => $user['username'],
                    'logged_in' => TRUE
                ]);
                $this->session->sess_regenerate(TRUE);
                redirect($user['role'] === 'admin' ? '/users/get-all' : '/profile');
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials.');
                redirect('/login');
            }
        }

        $data = [
            'success' => $this->session->flashdata('success'),
            'error'   => $this->session->flashdata('error')
        ];
        $this->call->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'role', 'username', 'logged_in']);
        $this->session->set_flashdata('success', 'You have been logged out.');
        redirect('/login');
    }

    public function profile_page()
    {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You must login first.');
            redirect('/login');
        }

        $user = $this->StudentsModel->get_profile($this->session->userdata('user_id'));
        $data = [
            'user'    => $user,
            'success' => $this->session->flashdata('success'),
            'error'   => $this->session->flashdata('error')
        ];

        $this->call->view('ui/profile', $data);
    }
}
