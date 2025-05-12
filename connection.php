<?php
include_once 'util.php';

class Database {
    public $host;
    public $username;
    public $password;
    public $db;
    public $conn;

    public function __construct() {
        $this->host = "localhost";
        $this->username = Util::$DB_USER;
        $this->password = Util::$DB_PASSWORD;
        $this->db = Util::$DB_NAME;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>
