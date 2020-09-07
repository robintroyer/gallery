<?php

class Database implements StorageInterface
{
    private $conn;
    public function initialize($config)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli($config->server, $config->username, $config->password);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }

        $sql = "CREATE DATABASE gallery";
        if ($this->conn->query($sql)) {
            echo 'Database created successfully';
        } else {
            echo 'Error creating database: ' . $this->conn->error;
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