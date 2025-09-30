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

            // Redirect based on role: admin -> users/view, others -> auth/dashboard
            if ($role === 'admin') {
                redirect('users/view');
            } else {
                redirect('auth/dashboard');
            }
            
            
        } else {
            echo 'Login failed!';
        }
    }

    $this->call->view('auth/login');
    }

    public function dashboard()
    {
        $this->call->library('auth');
        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }
        $this->call->view('auth/dashboard');
    }




    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
?>