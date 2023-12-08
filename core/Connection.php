<?php

class Connection {
    private static $instance = null;
    private $conn = null;

    private function __construct($config) {
        try {
            // Cấu hình DSN
            $dsn = 'mysql:dbname=' . $config['db'] . ';host=' . $config['host'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            
            // Khởi tạo kết nối PDO
            $this->conn = new PDO($dsn, $config['user'],"", $options);
        } catch (Exception $exception) {
            echo '<h1>Kết nối thất bại:</h1>';
            echo '</br>';
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public static function getInstance($config) {
        if (self::$instance == null) {
            self::$instance = new Connection($config);
        }
        return self::$instance->conn;
    }
}
