<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function getProfile($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get("tb_about");
        return $query;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('tb_about', $data);
        return $query;
    }
}
