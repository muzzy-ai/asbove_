<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

    // Menampilkan semua pesanan
    public function pesanan()
    {
        $data = array(
            'title' => 'Daftar Pesanan',
            'page' => 'admin/pesanan',
            'getAllPesanan' => $this->admin_model->get_orders()
        );
        $this->load->view('admin/template/main', $data);
    }

    // Menampilkan detail pesanan berdasarkan ID
    public function pesanan_detail()
    {
        $order_id = $this->input->get('id', true);
        if (empty($order_id)) {
            redirect('admin/pesanan');
        }

        $data = array(
            'title' => 'Detail Pesanan',
            'page' => 'admin/pesanan_detail',
            'order_detail' => $this->admin_model->get_order_detail($order_id)
        );
        $this->load->view('admin/template/main', $data);
    }

    // Mengupdate status pesanan
    public function updateStatus()
    {
        if ($this->input->get()) {
            $order_id = $this->input->get('id', true);
            $status = $this->input->get('status', true);

            $cek_data = $this->admin_model->get_order_detail($order_id);
            if (!empty($cek_data['order'])) {
                $data = array('status' => $status);
                $update = $this->admin_model->update_order($order_id, $data);

                if ($update) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Status Berhasil Di Update!<i class="remove ti-close" data-dismiss="alert"></i></div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UPSS! </strong>Status Gagal Di Update! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                }
            }
            redirect('admin/pesanan');
        } else {
            redirect('admin/pesanan');
        }
    }

    // Menghapus pesanan berdasarkan ID
    public function delete()
    {
        $id = $this->input->get('id');
        
        if (!$id) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">ID tidak valid!</div>');
            redirect('admin/pesanan');
        }

        $this->db->where('id', $id);
        $this->db->delete('orders');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Pesanan berhasil dihapus!</div>');
        redirect('admin/pesanan');
    }
}
