<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
public function register()
{
    if ($this->io->method() === 'post') {
        $username = $this->io->post('username');
        $password = $this->io->post('password');
        $role = isset($_POST['role']) ? $_POST['role'] : 'user'; // ✅ fixed safely

        $this->call->library('auth');
        $this->auth->register($username, $password, $role);

        redirect('auth/login');
    } else {
        $this->call->view('auth/register');
    }
}


    public function login()
    {
    $this->call->library('session');
    $this->call->library('auth');

    if ($this->io->method() === 'post') {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        if ($this->auth->login($username, $password)) {

            // Get the user's role after successful login
            $role = $this->session->userdata('role');

            // Redirect based on role
            if ($role === 'admin') {
                redirect('auth/admin-dashboard');
            } else {
                redirect('auth/user-dashboard');
            }
            
            
        } else {
            echo 'Login failed!';
        }
    }

    $this->call->view('auth/login');
    }

    public function adminDashboard()
    {
        $this->call->library('auth');
        if (!$this->auth->is_logged_in() || !$this->auth->has_role('admin')) {
            redirect('auth/login');
        }
        $this->call->view('auth/admin_dashboard');
    }

    public function userDashboard()
    {
        $this->call->library('auth');
        if (!$this->auth->is_logged_in() || !$this->auth->has_role('user')) {
            redirect('auth/login');
        }
        $this->call->view('auth/user_dashboard');
    }




    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
?>