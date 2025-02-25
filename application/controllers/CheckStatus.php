<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CheckStatus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('katalog_model');
        $this->load->model('pesanan_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $email = $this->input->post('cek_email_pesanan');
        $data = $this->pesanan_model->cek_data_pesanan_by_email($email)->result();

        if ($data) {
            $response = [
                'status' => 'success',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data pesanan tidak ditemukan.'
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
