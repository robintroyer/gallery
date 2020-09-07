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
    public function saveGallery($data)
    {
        $sql = "SELECT `name`
        FROM galleries
        WHERE `name` = '" . $data->getName() . "'";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO galleries (`name`, `description`)
            VALUES ('" . $data->getName() . "', '" . $data->getDesc() . "')";
    
            if ($this->conn->query($sql)) {
                echo 'New record created successfully';
            } else {
                echo 'Error: ' . $sql . '<br />' . $this->conn->error;
            }
        } else {
            echo 'Diese Galerie ist bereits vorhanden.';
        }

        
    }

    public function saveImage($data)
    {
        $sql = "INSERT INTO images (gallery_id, title, `description`, image_path)
        VALUES ('" . $data->getGalleryID() . "', '" . $data->getTitle() . "', '" . $data->getDesc() . "', '" . $data->getImage() . "')";
        if ($this->conn->query($sql)) {
            echo 'New record created successfully';
        } else {
            echo 'Error: ' . $sql . '<br />' . $this->conn_error;
        }
    }

    public function editEntry($entry)
    {
        
    }
    public function getGalleries()
    {
        $entries = [];
        $sql = "SELECT id, `name`, `description`
        FROM galleries";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $entry = new Entry();
                $entry->setID($row['id']);
                $entry->setName($row['name']);
                $entry->setDesc($row['description']);
                $entries[] = $entry;
            }
        }
        return $entries;
    }
    public function getImages($id)
    {
        $images = [];
        $sql = "SELECT id, gallery_id, title, `description`, image_path
        FROM images
        WHERE gallery_id = '" . $id . "'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $image = new Image();
                $image->setGalleryID($row['gallery_id']);
                $image->setTitle($row['title']);
                $image->setDesc($row['description']);
                $image->setImage($row['image_path']);
                $images[] = $image;
            }
        }
        return $images;
    }
    public function deleteEntry($id)
    {

    }
    public function getSingleEntry($name)
    {
        $sql = "SELECT id, `name`, `description`
        FROM galleries
        WHERE `name` = '$name'";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $entry = new Entry();
                $entry->setID($row['id']);
                $entry->setName($row['name']);
                $entry->setDesc($row['description']);
                return $entry;
            }
        }
    }
}