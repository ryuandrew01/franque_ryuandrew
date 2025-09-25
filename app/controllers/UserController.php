<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    public function view() 
    {
        $page = (int) ($_GET['page'] ?? 1);
        $per_page = (int) ($_GET['per_page'] ?? 10);
        $per_page = max(1, min(100, $per_page));
        $pagination = $this->UserModel->paginate($per_page, max($page, 1), [], false, 'id', 'ASC');
        $data['users'] = $pagination['data'];
        // Fallback safety: If page 1 shows empty but there are records, show first batch
        if (empty($data['users']) && $pagination['total'] > 0 && $page === 1) {
            $all = $this->UserModel->all();
            $data['users'] = array_slice($all, 0, $per_page);
        }
        $data['pagination'] = $pagination;
        $data['per_page'] = $per_page;
        $this->call->view('users/view', $data);
    }

    public function create() 
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            try {
                $this->UserModel->insert($data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while creating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id) 
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            try {
                $this->UserModel->update($id, $data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while updating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['user'] = $this->UserModel->find($id);
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id) 
    {
        if ($this->io->method() === 'post') {
            // Actually delete the user (POST request from confirmation form)
            try {
                if ($this->UserModel->delete($id)) {
                    redirect('users/view');
                } else {
                    echo 'Something went wrong while deleting user';
                }
            } catch (Exception $e) {
                echo 'Something went wrong while deleting user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            // Show delete confirmation page (GET request from users table)
            $data['user'] = $this->UserModel->find($id);

            if (!$data['user']) {
                echo 'User not found';
                return;
            }

            $this->call->view('users/delete', $data);
        }
    }
}
