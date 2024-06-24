<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Katalog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('text');
    }

    public function get_all_katalog()
    {
        $this->db->select('*');
        $this->db->from('tb_katalog tbc');
        $this->db->join('tb_user tbu', 'tbu.id_user = tbc.id_user');
        $query = $this->db->get();
        return $query;
    }

    public function get_katalog_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_katalog tbc');
        $this->db->join('tb_user tbu', 'tbu.id_user = tbc.id_user');
        $this->db->where('tbc.id_katalog', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert('tb_katalog', $data);
    }

    public function update($id, $data)
    {

        $this->db->where('id_katalog', $id);
        $query = $this->db->update('tb_katalog', $data);
        return $query;
    }


    public function delete_by_id($id)
    {

        $this->db->where('id_katalog', $id);
        return $this->db->delete('tb_katalog');
    }
}
