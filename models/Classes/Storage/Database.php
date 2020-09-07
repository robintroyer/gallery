<?php

class Database implements StorageInterface
{
    private $conn;
    public function initialize($config)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli($config->server, $config->username, $config->password,
        $config->database);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }

        $sql = "CREATE TABLE galleries(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL
        )";
        if ($this->conn->query($sql)) {
            echo 'Table galleries created successfully';
        } else {
            echo 'Error creating table ' . $this->conn->error;
        }
    }
    public function saveEntry($data)
    {
        
    }
    public function editEntry($entry)
    {
        
    }
    public function getEntries()
    {
        
    }
    public function deleteEntry($id)
    {

    }
}