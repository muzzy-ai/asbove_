<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('checkout_model'); // Model untuk proses checkout
        $this->load->helper(array('form', 'url'));
        $this->load->library('cart'); // Memuat library cart untuk manajemen keranjang
    }

    public function index()
    {
        $data = array(
            'title' => 'Checkout',
            'page' => 'cart/tampilan_checkout', // Ubah lokasi view
            'cart_items' => $this->cart->contents(), // Ambil isi keranjang
            'total' => $this->cart->total() // Total pembelian
        );

        $this->load->view('landing/template/sites', $data); // Load tampilan checkout
    }

    public function process_payment()
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $order_data = array(
                'nama_pelanggan' => $post['name'],
                'email' => $post['email'], // Simpan email pelanggan
                'alamat' => $post['address'],
                'metode_pengiriman' => $post['shipping'],
                'total_pembelian' => $post['total'],
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            );
            $cart_items = $this->cart->contents();

            $insert = $this->checkout_model->insert_order($order_data,$cart_items);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Pesanan berhasil diproses!</div>');
                redirect('Checkout/payment_success');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Terjadi kesalahan, silakan coba lagi.</div>');
                redirect('Checkout');
            }
        } else {
            redirect('Checkout');
        }
    }

    public function payment_success()
    {
        $data = array(
            'title' => 'Pembayaran Berhasil',
            'page' => 'cart/payment_success' // Ubah lokasi view
        );

        $this->load->view('cart/payment_success', $data); // Load tampilan sukses
    }
}
