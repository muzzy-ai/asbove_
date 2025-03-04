<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['midtrans'] = [
    'server_key' => 'SB-Mid-server-EYMMbAuSFH0POH9gEvRpxr_N',
    'client_key' => 'SB-Mid-client-_Lmy8ZfnhcNSxh3b',
    'is_production' => false,
    'is_sanitized' => true,
    'is_3ds' => true
];

log_message('error', 'Midtrans Config Loaded: ' . print_r($config['midtrans'], true));
