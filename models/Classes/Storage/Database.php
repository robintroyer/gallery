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

        
    }
    public function saveEntry($data)
    {
        $sql = "INSERT INTO galleries (`name`)
        VALUES ('" . $data->getName() . "')";

        if ($this->conn->query($sql)) {
            echo 'New record created successfully';
        } else {
            echo 'Error: ' . $sql . '<br />' . $this->conn->error;
        }
    }
    public function editEntry($entry)
    {
        
    }
    public function getEntries()
    {
        $entries = [];
        $sql = "SELECT `name`
        FROM galleries";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $entries[] = $row['name'];
            }
        }
        return $entries;
    }
    public function deleteEntry($id)
    {

    }
}