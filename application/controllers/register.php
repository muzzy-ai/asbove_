<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data = array('title' => 'Register - HIMTI Official Merchandise');
            $this->load->view('admin/register', $data);
        } else {
            if ($this->input->post()) {
                $post = $this->input->post();
                $data = [
                    'username' => $post["username"],
                    'password' => password_hash($post["password"], PASSWORD_DEFAULT),
                    'role' => 2 // Default role sebagai user biasa
                ];

                if ($this->user_model->insertUser($data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi berhasil! Silakan login.</div>');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Registrasi gagal! Silakan coba lagi.</div>');
                    redirect('register');
                }
            }
        }
    }
}
