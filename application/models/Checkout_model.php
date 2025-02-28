<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    public function insert_order($order_data, $cart_items)
    {
        // Simpan data utama order ke tabel `orders`
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id(); // Ambil ID order yang baru saja dibuat

        // Simpan semua item yang dibeli ke tabel `order_items`
        foreach ($cart_items as $item) {
            $order_item = array(
                'order_id'  => $order_id,
                'product_id'=> $item['id'], // Sesuaikan dengan ID produk di database
                'quantity'  => $item['qty'],
                'price'     => $item['price'],
                'size'      => isset($item['options']['size']) ? $item['options']['size'] : NULL, // Menghindari error jika size tidak ada
                'subtotal'  => $item['subtotal']
            );

            $this->db->insert('order_items', $order_item);
        }

        return $order_id;
    }

    public function insert_transaction($data)
    {
        return $this->db->insert('transactions', $data);
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

}
