<?php

class Form {
    private $storage;
    public function __construct($config)
    {
        $this->storage = $config->storage;
    }
    public function newGalleryForm()
    {
        $input_name = '<input type="text" name="gallery_name"><br />';
        $input_desc = '<textarea type="text" name="gallery_desc"></textarea><br />';
        $new_gallery_button = '<input type="submit" name="new_gallery_button" value="Senden">';

        echo '<h1>Neue Galerie anlegen:</h1>';
        echo '<form method="post">' . $input_name . $input_desc . $new_gallery_button . '</form>';
        if (isset($_POST['gallery_name'])) {
            if (!empty($_POST['gallery_name'])) {
                $entry = new Entry();
                $entry->setName($_POST['gallery_name']);
                $entry->setDesc($_POST['gallery_desc']);
                print_r($entry);
                $this->storage->saveEntry($entry);
            }          
        }
    }
    public function newImageForm($gallery_id)
    {
        echo 'Neues Bild hochladen:';
        $input_title = '<input type="text" name="title"><br />';
        $input_desc = '<textarea type="text" name="desc"></textarea><br />';
        $input_gallery_id = '<input type="hidden" name="gallery_id" value="' . $gallery_id . '">';

        $upload = '<input type="file" name="upload">';
        $upload_button = '<input type="submit" name="upload_button" value="hochladen">';
        echo '<form method="post" enctype="multipart/form-data">' . $input_title . $input_desc
        . $input_gallery_id . $upload . $upload_button . '</form>';

        if (isset($_POST['upload_button'])) {
            $filehandler = new Filehandler($this->storage);
            $filehandler->uploadFile();
        }
    }
}