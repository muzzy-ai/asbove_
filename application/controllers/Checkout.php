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
        log_message('error', 'POST Data: ' . print_r($post, true));

        if (!$post) {
            log_message('error', 'POST data tidak ditemukan!');
            echo json_encode(['error' => 'POST data tidak ditemukan!']);
            return;
        }

        // Validasi input
        $name     = $post['name'] ?? null;
        $email    = $post['email'] ?? null;
        $address  = $post['address'] ?? null;
        $shipping = $post['shipping'] ?? null;
        $total    = isset($post['total']) ? (int)$post['total'] : 0;

        if (!$name || !$email || !$address || !$shipping || $total <= 0) {
            echo json_encode(['error' => 'Data tidak lengkap']);
            return;
        }

        // Simpan Order ke Database
        $order_id = 'ORDER-' . time();
        $order_data = [
            'id'                => $order_id,
            'nama_pelanggan'    => $name,
            'email'             => $email,
            'alamat'            => $address,
            'metode_pengiriman' => $shipping,
            'total_pembelian'   => $total,
            'status'            => 'pending',
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $cart_items = $this->cart->contents();
        $this->Checkout_model->insert_order($order_data, $cart_items);

        // Siapkan data transaksi untuk Midtrans
        $transaction_details = [
            'order_id'    => $order_id,
            'gross_amount'=> $total
        ];

        $item_details = [];
        foreach ($cart_items as $item) {
            $item_details[] = [
                'id'       => $item['id'],
                'price'    => (int)$item['price'],
                'quantity' => $item['qty'],
                'name'     => $item['name']
            ];
        }

        $customer_details = [
            'first_name' => $name,
            'email'      => $email
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details
        ];

        try {
            // Log data transaksi untuk debugging
            log_message('error', 'Data transaksi ke Midtrans: ' . print_r($transaction, true));
            // Dapatkan snap token dari Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);

            // Simpan transaksi ke database
            $transaction_data = [
                'order_id'           => $order_id,
                'payment_type'       => '',
                'gross_amount'       => $total,
                'transaction_status' => 'pending',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ];
            $this->Checkout_model->insert_transaction($transaction_data);
    
            echo json_encode(['token' => $snapToken]);
        } catch (Exception $e) {
            log_message('error', 'Error dari Midtrans: ' . $e->getMessage());
            echo json_encode(['error' => 'Gagal memproses pembayaran! ' . $e->getMessage()]);
        }
    }

    public function midtrans_callback()
    {
        // Ambil data JSON dari Midtrans
        $json_str = file_get_contents('php://input');
        $response = json_decode($json_str, true);

        log_message('error', 'Midtrans Callback: ' . print_r($response, true));

        if (!$response) {
            log_message('error', 'Invalid Midtrans callback data');
            return;
        }

        $order_id = $response['order_id'] ?? null;
        $transaction_id = $response['transaction_id'] ?? null;
        $status = $response['transaction_status'] ?? null;
        $payment_type = $response['payment_type'] ?? null;
        $gross_amount = $response['gross_amount'] ?? null;

        if (!$order_id || !$transaction_id || !$status) {
            log_message('error', 'Missing required parameters in Midtrans callback');
            return;
        }

        // Perbarui status transaksi di database
        $update_data = [
            'transaction_id'     => $transaction_id,
            'payment_type'       => $payment_type,
            'gross_amount'       => $gross_amount,
            'transaction_status' => $status,
            'updated_at'         => date('Y-m-d H:i:s')
        ];
    
        $this->Checkout_model->update_transaction($order_id, $update_data);

        // Jika pembayaran sukses, ubah status order
        if ($status == 'settlement' || $status == 'capture') {
            $this->Checkout_model->update_order_status($order_id, 'paid');
        } elseif ($status == 'cancel' || $status == 'expire' || $status == 'deny') {
            $this->Checkout_model->update_order_status($order_id, 'failed');
        }

        log_message('error', 'Transaction updated: ' . print_r($update_data, true));
    }




}
