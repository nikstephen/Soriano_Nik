<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('pagination');

        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav' => 'pagination-nav',
            'ul' => 'pagination-list',
            'li' => 'pagination-item',
            'a' => 'pagination-link',
            'active' => 'active'
        ]);

    }
      public function get_all($page = 1)
    {
        $per_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 10;
        }

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
            'records' => $records,
            'total_records' => $total_rows,
            'pagination_data' => $pagination_data,
            'pagination_links' => $this->pagination->paginate(),
            'search' => $search,
            'show_deleted' => $show_deleted
        ];

        $this->call->view('ui/get_all', $data);
    }

    public function deleted($page = 1)
    {
        $_GET['show'] = 'deleted';
        $this->get_all($page);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('users/get-all');
        }
        $this->call->view('ui/create');
    }

    public function update($id)
    {
        $user = $this->StudentsModel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('users/get-all');
        }
        $this->call->view('ui/update', ['user' => $user]);
    }

    public function delete($id)
    {
        $this->StudentsModel->soft_delete($id);
        redirect('users/get-all');
    }

    public function hard_delete($id)
    {
        $this->StudentsModel->hard_delete($id);
        redirect('users/get-all?show=deleted');
    }

    public function restore($id)
    {
        $this->StudentsModel->restore($id);
        redirect('users/get-all?show=deleted');
    }
}
