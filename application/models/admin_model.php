<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    // Ambil semua pesanan
    public function get_orders()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('orders')->result();
    }

    // Ambil detail pesanan berdasarkan order_id
    public function get_order_detail($order_id)
    {
        $this->db->where('id', $order_id);
        $order = $this->db->get('orders')->row();

        $this->db->select('order_items.*, products.name as product_name');
        $this->db->from('order_items');
        $this->db->join('products', 'products.id = order_items.product_id');
        $this->db->where('order_items.order_id', $order_id);
        $items = $this->db->get()->result();

        return [
            'order' => $order,
            'items' => $items
        ];
    }

    // Update status pesanan berdasarkan order_id
    public function update_order($order_id, $data)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', $data);
    }

    // Hapus pesanan berdasarkan order_id
    public function delete_order($order_id)
    {
        $this->db->where('id', $order_id);
        return $this->db->delete('orders');
    }
}
        