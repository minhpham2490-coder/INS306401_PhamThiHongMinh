<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            // Thiết lập kết nối PDO bảo mật [cite: 8, 62]
            $this->connection = new PDO(
                "mysql:host=localhost;dbname=ecommerce_db;charset=utf8mb4", 
                "root", 
                "", 
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
