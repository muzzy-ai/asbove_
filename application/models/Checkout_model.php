<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    public function insert_order($order_data, $cart_items)
    {
        $this->db->trans_start(); // Mulai transaksi

        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        if (!$order_id) {
            log_message('error', 'Gagal menyimpan order ke database!');
            return false;
        }

        log_message('info', 'Order berhasil disimpan dengan ID: ' . $order_id);

        // Persiapkan data untuk order items
        $order_items = [];
        foreach ($cart_items as $item) {
            $order_items[] = [
                'order_id'   => $order_id,
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'price'      => $item['price'],
                'size'       => isset($item['options']['size']) ? $item['options']['size'] : NULL,
                'subtotal'   => $item['subtotal']
            ];
        }

        // Insert batch untuk order_items
        if (!empty($order_items)) {
            $this->db->insert_batch('order_items', $order_items);
        }

        $this->db->trans_complete(); // Selesai transaksi

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaksi gagal disimpan ke database!');
            return false;
        }

        return $order_id;
    }

    public function insert_transaction($transaction_data)
    {
        if ($this->db->insert('transactions', $transaction_data)) {
            log_message('info', 'Transaksi berhasil disimpan dengan Order ID: ' . $transaction_data['order_id']);
            return true;
        } else {
            log_message('error', 'Gagal menyimpan transaksi untuk Order ID: ' . $transaction_data['order_id']);
            return false;
        }
    }

    public function get_transaction_by_order_id($order_id)
    {
        return $this->db->get_where('transactions', ['order_id' => $order_id])->row_array();
    }

    public function update_transaction_status($order_id, $status)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->update('transactions', ['status' => $status]);
    }

    public function update_transaction($order_id, $update_data)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('transactions', $update_data);
    }

    public function update_order_status($order_id, $status)
    {
        $this->db->where('id', $order_id);
        $this->db->update('orders', ['status' => $status]);
    }

}
?>
