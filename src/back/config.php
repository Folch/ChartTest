<?php


$config['serverdb'] = 'localhost';
$config['userdb'] = 'root';
$config['passdb'] = '1234';
$config['ddbb'] = 'IntelliPharm';

$config['debug'] = true;


if ($config['debug']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
