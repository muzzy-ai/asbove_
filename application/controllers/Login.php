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
        // $passDefault = password_hash('admin123', PASSWORD_DEFAULT);
        // var_dump($passDefault);
        // die;

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'HIMTI Official Merchandise',
            );
            $this->load->view('admin/login', $data);
        } else {
            //validasi success
            if ($this->input->post()) {

                $post = $this->input->post();

                //cari user berdasarkan username

                $where1 = $post["username"];
                // $where2 = array('username' => $post['username'], 'id_user' => 2);

                $user = $this->user_model->getUserByUsername1($where1)->row();

                // var_dump($user);
                // die;

                // jika user terdaftar

                if ($user) {
                    //perikas password
                    $isPasswordTrue = password_verify($post["password"], $user->password);

                    //generate session
                    $array = array(
                        'id_user' => $user->id_user,
                        'username' => $user->username
                    );
                    $this->session->set_userdata($array);

                    if ($isPasswordTrue) {
                        redirect('admin/Dashboard');
                        return true;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><strong>Upss </strong>Password
                        Anda Tidak Sesuai!</div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Username
                    Anda Tidak Terdaftar!</div>');
                    redirect('login');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('login');
    }
}
