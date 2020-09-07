<?php

class Filehandler
{
    private $storage;
    private $dir;
    private $extension;
    private $file;
    private $uploadOK;
    public function __construct($storage)
    {
        $this->storage = $storage;
        $this->dir = 'C:/xampp/htdocs/gallery/images/';
        $this->file = $this->dir . basename($_FILES['upload']['name']);
        $this->extension = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        if (getimagesize($_FILES['upload']['tmp_name']) === false) {
            $this->uploadOK = 0;
        } else {
            $this->uploadOK = 1;
        }
    }
    public function uploadFile()
    {
        if ($this->uploadOK) {
            if (copy($_FILES['upload']['tmp_name'], $this->file)) {
                echo 'Die Datei ' . basename($_FILES['upload']['tmp_name']) . ' wurde hochgeladen.';
                // echo '<br />';
                // echo $this->file;

            } else {
                echo 'Fehler beim Hochladen der Datei';
            }
        } else {
            echo 'Bitte laden Sie ein Bild hoch';
        }
    }
}