<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Order_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('cart');

       
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

    public function process_payment() {
        $this->load->library('midtrans');
        
        $postData = $this->input->post();
        $cart_items = $this->cart->contents();

        if (empty($cart_items)) {
            echo json_encode(['error' => 'Keranjang kosong']);
            return;
        }

        $order_id = $this->Order_model->createOrder($postData, $cart_items);

        // Data untuk Midtrans
        $transaction = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $postData['total']
            ],
            'customer_details' => [
                'first_name' => $postData['name'],
                'email' => $postData['email'],
                'address' => $postData['address']
            ]
        ];

        try {
            $snapToken = $this->midtrans->getSnapToken($transaction);
            echo json_encode(['token' => $snapToken]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function payment_callback()
    {
        $json = file_get_contents("php://input");
        $result = json_decode($json, true);

        if ($result && isset($result['transaction_status'])) {
            $order_id = $result['order_id'];
            $transaction_status = $result['transaction_status'];

            if ($transaction_status == "settlement") { // Pembayaran sukses
                // Update status pesanan jadi "Paid"
                $this->db->where('id', $order_id);
                $this->db->update('orders', ['status' => 'paid']);

                // Kosongkan keranjang setelah pembayaran berhasil
                $this->cart->destroy();

                // Kirim notifikasi email
                $this->send_payment_email($result['customer_details']['email']);

                log_message('info', "Pembayaran sukses untuk Order ID: " . $order_id);
                redirect('himtihom/');

            }
        }
    }

    private function send_payment_email($email)
    {
        $this->load->library('email');

        $this->email->from('no-reply@yourwebsite.com', 'Toko Online');
        $this->email->to($email);
        $this->email->subject('Konfirmasi Pembayaran Berhasil');
        $this->email->message("Terima kasih! Pembayaran Anda telah diterima. Mohon cek email ini secara berkala untuk informasi selengkapnya.");

        if ($this->email->send()) {
            log_message('info', "Email pembayaran berhasil dikirim ke: " . $email);
        } else {
            log_message('error', "Gagal mengirim email ke: " . $email);
        }
    }


}
    
