<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('cart');
        $this->load->model('katalog_model');
        $this->load->helper('text');
    }

    public function detail_keranjang()
    {
        $data = array(
            'title' => 'Detail Keranjang',
            'page' => 'cart/detail_keranjang',
            'cart_items' => $this->cart->contents()
        );

        $this->load->view('landing/template/sites', $data);
    }

    public function hapus_item($rowid)
    {
        if ($rowid) {
            $this->cart->remove($rowid);
        }
        redirect('Cart/detail_keranjang');
    }

    public function kosongkan_keranjang()
    {
        $this->cart->destroy();
        redirect('Cart/detail_keranjang');
    }
}
