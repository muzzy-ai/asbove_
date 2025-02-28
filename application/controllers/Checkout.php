<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Checkout_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('cart');
        $this->config->load('config_midtrans'); // Pastikan konfigurasi dimuat

        // Load Midtrans Library
        require_once APPPATH . 'third_party/midtrans/Midtrans.php';

        $midtransConfig = $this->config->item('midtrans');

        // Log untuk debug
        log_message('error', 'Midtrans Config: ' . print_r($midtransConfig, true));

        // Cek apakah konfigurasi ada sebelum mengaksesnya
        if (!isset($midtransConfig) || empty($midtransConfig['server_key'])) {
            show_error("Konfigurasi Midtrans tidak ditemukan atau kosong!", 500);
            return;
        }

        \Midtrans\Config::$serverKey = $midtransConfig['server_key'];
        \Midtrans\Config::$isProduction = $midtransConfig['is_production'];
        \Midtrans\Config::$isSanitized = $midtransConfig['is_sanitized'];
        \Midtrans\Config::$is3ds = $midtransConfig['is_3ds'];
    }

    public function index()
    {
        $midtransConfig = $this->config->item('midtrans');

        $data = array(
            'title' => 'Checkout',
            'page' => 'cart/tampilan_checkout',
            'cart_items' => $this->cart->contents(),
            'total' => $this->cart->total(),
            'client_key' => $midtransConfig['client_key'] ?? ''
        );

        $this->load->view('landing/template/sites', $data);
    }

    public function process_payment()
    {
        $post = $this->input->post();
        if (!$post) {
            redirect('checkout');
            return;
        }

        // Pastikan semua data yang dibutuhkan tersedia
        $name = $post['name'] ?? null;
        $email = $post['email'] ?? null;
        $address = $post['address'] ?? null;
        $shipping = $post['shipping'] ?? null;
        $total = isset($post['total']) ? (int) $post['total'] : 0;

        if (!$name || !$email || !$address || !$shipping || $total <= 0) {
            echo json_encode(['error' => 'Data tidak lengkap']);
            return;
        }

        // Simpan Order ke Database
        $order_id = 'ORDER-' . time();
        $order_data = array(
            'id' => $order_id,
            'nama_pelanggan' => $name,
            'email' => $email,
            'alamat' => $address,
            'metode_pengiriman' => $shipping,
            'total_pembelian' => $total,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        );

        $cart_items = $this->cart->contents();
        $this->Checkout_model->insert_order($order_data, $cart_items);

        // Midtrans Payment Gateway
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $total
        );

        $item_details = [];
        foreach ($cart_items as $item) {
            $item_details[] = array(
                'id' => $item['id'],
                'price' => (int) $item['price'],
                'quantity' => $item['qty'],
                'name' => $item['name']
            );
        }

        $customer_details = array(
            'first_name' => $name,
            'email' => $email
        );

        $transaction = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details
        );

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            echo json_encode(['token' => $snapToken]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
