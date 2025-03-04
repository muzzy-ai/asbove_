<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/midtrans/Midtrans.php';

class Midtrans {

    private $server_key = 'SB-Mid-server-EYMMbAuSFH0POH9gEvRpxr_N'; // Ganti dengan server key dari Midtrans
    private $is_production = false;

    public function __construct() {
        \Midtrans\Config::$serverKey = $this->server_key;
        \Midtrans\Config::$isProduction = $this->is_production;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function getSnapToken($params) {
        return \Midtrans\Snap::getSnapToken($params);
    }
}
