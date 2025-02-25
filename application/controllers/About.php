<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'HIMTI Official Merchandise',
            'page' => 'landing/about',
            'getDataWeb' => $this->profile_model->getProfile('1')->row()
        );
        $this->load->view('landing/template/sites', $data);
    }
}
