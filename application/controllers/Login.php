<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array('title' => 'ASBOVE');
            $this->load->view('admin/login', $data);
        } else {
            if ($this->input->post()) {
                $post = $this->input->post();
                $username = $post["username"];

                // Ambil data user berdasarkan username
                $user = $this->user_model->getUserByUsername($username)->row();

                if ($user) {
                    // Periksa password
                    if (password_verify($post["password"], $user->password)) {
                        // Buat session
                        $session_data = array(
                            'id_user' => $user->id_user,
                            'username' => $user->username,
                            'role' => $user->role // Pastikan ada kolom role di tabel user
                        );
                        $this->session->set_userdata($session_data);

                        // Cek role user dan redirect sesuai role
                        if ($user->role == 1) {
                            redirect('admin/Dashboard'); // Admin
                        } else {
                            redirect('beranda'); // Pengguna biasa
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password Anda salah!</div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
                    redirect('login');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy();
        redirect('login');
    }
}
