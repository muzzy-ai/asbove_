<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda Tidak Memiliki Akses, silahkan login</div>');
            redirect("login");
        }
        $this->load->model('admin_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'HIMTI Official Merchandise',
            'page' => 'admin/pesanan',
            'getAllPesanan' => $this->admin_model->get_orders()
        );
        $this->load->view('admin/template/main', $data);
    }

    public function updateStatus()
    {
        if ($this->input->get()) {
            $get = $this->input->get();
            $cek_data = $this->pesanan_model->get_pesanan_by_id($get['id'])->num_rows();

            if ($cek_data > 0) {
                $data = array(
                    'status' => $get['status'],
                );

                $update = $this->pesanan_model->update($get['id'], $data);

                if ($update) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Status Berhasil Di Update!<i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Pesanan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UPSS! </strong>Status Gagal Di Update! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Pesanan');
                }
            }
        } else {
            redirect('admin/Pesanan');
        }
    }

    public function delete()
    {
        if (!empty($this->input->get('id', true))) {
            $delete = $this->pesanan_model->delete_by_id($this->input->get('id', true));

            if ($delete) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Data Berhasil Di Hapus!<i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Pesanan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UPSS! </strong>Data Gagal Di Hapus! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Pesanan');
            }
        } else {
            redirect('admin/Pesanan');
        }
    }
}
