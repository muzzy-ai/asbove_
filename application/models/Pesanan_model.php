<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('text');
    }

    public function get_all_pesanan()
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $query = $this->db->get();
        return $query;
    }


    public function get_all_laporan()
    {
        $this->db->select('id_order, tbo.id_katalog, image, nama_paket, harga,status, Count(*) As jumlah_pesanan');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->group_by('tbo.id_katalog');
        $query = $this->db->get();
        return $query;
    }
    public function get_count_pesanan($status)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        if ($status != 'all') {
            $this->db->where('tbo.status', $status);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pesanan_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->where('tbo.id_order', $id);
        $query = $this->db->get();
        return $query;
    }

    public function cek_data_pesanan($id, $email, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_katalog tbc', 'tbc.id_katalog = tbo.id_katalog');
        $this->db->where('tbo.id_katalog', $id);
        $this->db->where('tbo.email_pemesan', $email);
        $this->db->where('tbo.tanggal', $tanggal);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert('tb_order', $data);
    }

    public function update($id, $data)
    {

        $this->db->where('id_order', $id);
        $query = $this->db->update('tb_order', $data);
        return $query;
    }


    public function delete_by_id($id)
    {

        $this->db->where('id_order', $id);
        return $this->db->delete('tb_order');
    }
}
