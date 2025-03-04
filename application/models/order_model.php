<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function generateUniqueId($length = 15) {
        return 'ORD-' . substr(md5(uniqid(mt_rand(), true)), 0, $length);
    }

    public function createOrder($data, $cart_items) {
        $order_id = $this->generateUniqueId();

        $orderData = [
            'id' => $order_id,
            'nama_pelanggan' => $data['name'],
            'email' => $data['email'],
            'alamat' => $data['address'],
            'metode_pengiriman' => $data['shipping'],
            'total_pembelian' => $data['total'],
            'status' => 'pending'
        ];

        $this->db->insert('orders', $orderData);

        foreach ($cart_items as $item) {
            $orderItemData = [
                'order_id' => $order_id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
                'size' => isset($item['options']['size']) ? $item['options']['size'] : null
            ];
            $this->db->insert('order_items', $orderItemData);
        }

        return $order_id;
    }
}
