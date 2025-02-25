<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil data user berdasarkan username
    public function getUserByUsername($username)
    {
        return $this->db->get_where('tb_user', ['username' => $username]);
    }

    // Ambil data user dengan filter
    public function getUserByFilter($where)
    {
        return $this->db->select('id_user, nama, username, password')
            ->from('tb_user')
            ->where($where)
            ->get();
    }

    // Ambil semua user
    public function getAllUser()
    {
        $this->db->order_by("id_user", "desc");
        return $this->db->get("tb_user");
    }

    // Simpan user baru ke database
    public function insertUser($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    // Periksa apakah username sudah ada
    public function isUsernameExists($username)
    {
        $query = $this->db->get_where('tb_user', ['username' => $username]);
        return $query->num_rows() > 0; // Jika lebih dari 0, berarti username sudah ada
    }
}
