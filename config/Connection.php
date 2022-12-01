<?php

class Connection {
    private $connection;
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'tb_tech',
        'port' => '3306',
        'username' => 'root',
        'password' => 'Holamundo2r%',
        'charset' => 'utf8mb4'
    ];

    public function __construct() {
        
    }

    public function connect() {
        try {
            $driver = $this->config['driver'];
            $host = $this->config['host'];
            $database = $this->config['database'];
            $port = $this->config['port'];
            $user = $this->config['username'];
            $password = $this->config['password'];
            $charset = $this->config['charset'];

            $url = "{$driver}:host={$host}:{$port};"."dbname={$database};charset={$charset}";

            $this->connection = new PDO($url, $user, $password);
            return $this->connection;
        } catch(PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }
}