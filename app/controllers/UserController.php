<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('auth');

        if (!$this->auth->is_logged_in()){
            redirect('auth/login');
            exit;
        }
    }

	public function view() 
	{
		$page = (int) ($_GET['page'] ?? 1);
		$per_page = (int) ($_GET['per_page'] ?? 10);
		$per_page = max(1, min(100, $per_page));
		$search = trim($_GET['search'] ?? '');
		
		// Get all users first, then filter if search is provided
		$all_users = $this->UserModel->all();
		
		if (!empty($search)) {
			// Filter users by search term
			$filtered_users = array_filter($all_users, function($user) use ($search) {
				$search_lower = strtolower($search);
				return (
					strpos(strtolower($user['id']), $search_lower) !== false ||
					strpos(strtolower($user['username']), $search_lower) !== false ||
					strpos(strtolower($user['email']), $search_lower) !== false
				);
			});
			$all_users = array_values($filtered_users);
		}
		
		// Manual pagination
		$total = count($all_users);
		$offset = ($page - 1) * $per_page;
		$users = array_slice($all_users, $offset, $per_page);
		
		$data['users'] = $users;
		$data['pagination'] = [
			'data' => $users,
			'total' => $total,
			'per_page' => $per_page,
			'current_page' => $page,
			'last_page' => (int) ceil($total / max(1, $per_page))
		];
		$data['per_page'] = $per_page;
		$data['search'] = $search;
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
