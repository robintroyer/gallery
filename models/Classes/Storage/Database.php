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
    public function editGallery($gallery)
    {
        $sql = "UPDATE galleries
        SET name = '" . $gallery->getName() . "',
        `description` = '" . $gallery->getDesc() . "'
        WHERE id = '" . $gallery->getID() . "'";
        if ($this->conn->query($sql)) {
            echo 'Record updated successfully';
        } else {
            echo 'Error updating record';
        }
    }
    public function editImage($image)
    {
        if (!empty($image->getImage())) {
            $sql = "UPDATE images
            SET title = '" . $image->getTitle() . "',
            `description` = '" . $image->getDesc() . "',
            image_path = '" . $image->getImage() . "'
            WHERE id = '" . $image->getID() . "'";
        } else {
            $sql = "UPDATE images
            SET title = '" . $image->getTitle() . "',
            `description` = '" . $image->getDesc() . "'
            WHERE id = '" . $image->getID() . "'";
        }
        if ($this->conn->query($sql)) {
            echo 'Record updated successfully';
        } else {
            echo 'Error updating record';
        }
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
    public function getImages($gallery_id)
    {
        $images = [];
        $sql = "SELECT id, gallery_id, title, `description`, image_path
        FROM images
        WHERE gallery_id = '" . $gallery_id . "'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $image = new Image();
                $image->setID($row['id']);
                $image->setGalleryID($row['gallery_id']);
                $image->setTitle($row['title']);
                $image->setDesc($row['description']);
                $image->setImage($row['image_path']);
                $images[] = $image;
            }
        }
        return $images;
    }
    public function deleteGallery($gallery_id)
    {
        $sql = "DELETE
        FROM galleries
        WHERE id = '$gallery_id'";
        if ($this->conn->query($sql)) {
            echo 'Record deleted successfully';
        } else {
            echo 'Error deleting record: ' . $this->conn->error;
        }
        echo '<script type="text/javascript">window.location="http://localhost/gallery/";</script>';
    }
    public function deleteImage($image_id)
    {
        $sql = "DELETE
        FROM images
        WHERE id = '$image_id'";
        if ($this->conn->query($sql)) {
            echo 'Record deleted successfully';
        } else {
            echo 'Error deleting record: ' . $this->conn->error;
        }
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