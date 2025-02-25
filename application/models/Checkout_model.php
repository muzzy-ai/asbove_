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
                'order_id' => $order_id,
                'product_id' => $item['id'], // Sesuaikan dengan ID produk di database
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            );

            $this->db->insert('order_items', $order_item);
        }

        return $order_id;
    }
}
