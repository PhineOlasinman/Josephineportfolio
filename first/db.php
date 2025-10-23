<?php
class Database {
    private $servername = "localhost";
    private $username = "root";   // default for XAMPP
    private $password = "";       // leave blank for XAMPP
    private $dbname = "myportfolio";
    private $conn = null;         // initialize connection variable

    // Connect to the database using PDO
    public function connect() {
        // Return existing connection if already connected
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            $this->conn = new PDO(
                "mysql:host={$this->servername};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            // Set PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Display a clear error and stop execution
            die("Database Connection Failed: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
