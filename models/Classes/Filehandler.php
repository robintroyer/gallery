<?php
class Filehandler
{
    private $storage;
    private $dir;
    private $file;
    private $uploadOK;
    public function __construct($storage)
    {
        $this->storage = $storage;
        $this->dir = 'C:/xampp/htdocs/gallery/images/';
        if (isset($_FILES['upload'])) {
            $this->file = $this->dir . basename($_FILES['upload']['name']);
            if (getimagesize($_FILES['upload']['tmp_name']) === false) {
                $this->uploadOK = 0;
            } else {
                $this->uploadOK = 1;
            }
        }
        if (isset($_FILES['edit_upload'])) {
            $this->file = $this->dir . basename($_FILES['edit_upload']['name']);
            if ($_FILES['edit_upload']['error'] == 4) {
                $this->uploadOK = 1;
            } else {
                if (getimagesize($_FILES['edit_upload']['tmp_name']) === false) {
                    $this->uploadOK = 0;
                } else {
                    $this->uploadOK = 1;
                }
            }
            
        }
    }
    public function uploadFile()
    {
        if ($this->uploadOK) {
            if (copy($_FILES['upload']['tmp_name'], $this->file)) {
                echo 'Die Datei ' . basename($_FILES['upload']['tmp_name']) . ' wurde hochgeladen.';
                $image = new Image();
                $image->setGalleryID($_POST['gallery_id']);
                $image->setTitle($_POST['title']);
                $image->setDesc($_POST['desc']);
                $image->setImage($this->file);
                $this->storage->saveImage($image);
            } else {
                echo 'Fehler beim Hochladen der Datei';
            }
        } else {
            echo 'Bitte laden Sie ein Bild hoch';
        }
    }

    public function editFile()
    {
        if ($_FILES['edit_upload']['error'] == 4) {
            $image = new Image();
            echo $_POST['edit_id'];
            $image->setID($_POST['edit_id']);
            $image->setGalleryID($_POST['edit_gallery_id']);
            $image->setTitle($_POST['edit_title']);
            $image->setDesc($_POST['edit_desc']);
            $this->storage->editImage($image);
        } else {
            if ($this->uploadOK) {
                if (copy($_FILES['edit_upload']['tmp_name'], $this->file)) {
                    $image = new Image();
                    echo $_POST['edit_id'];
                    $image->setID($_POST['edit_id']);
                    $image->setGalleryID($_POST['edit_gallery_id']);
                    $image->setTitle($_POST['edit_title']);
                    $image->setDesc($_POST['edit_desc']);
                    $image->setImage($this->file);
                    $this->storage->editImage($image);
                } else {
                    echo 'Fehler beim Hochladen der Datei';
                }
            } else {
                echo 'Bitte laden Sie nur Bilder hoch';
            }
        }
    }
}