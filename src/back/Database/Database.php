<?php

require_once __DIR__ . '/../config.php';

class Database
{
    public static function getCon(): ?mysqli
    {
        global $config;
        $conn = new mysqli($config['serverdb'], $config['userdb'], $config['passdb'], $config['ddbb']);
        if ($conn->connect_errno > 0) {
            die('Unable to connect to database [' . $conn->connect_error . ']');
        }
        return $conn;
    }

}
