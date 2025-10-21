<?php
class Database {
    private $servername = "localhost";
    private $username = "root";   // default for XAMPP
    private $password = "";       // leave blank for XAMPP
    private $dbname = "myportfolio";
    private $conn; // connection variable

    public function connect() {
        // Return existing connection if already connected
        if ($this->conn) return $this->conn;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->servername};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
