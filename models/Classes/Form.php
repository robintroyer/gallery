<?php

class Form {
    private $storage;
    public function __construct($config)
    {
        $this->storage = $config->storage;
    }
    public function newGalleryForm()
    {
        $input_name = '<input type="text" name="gallery_name">';
        $new_gallery_button = '<input type="submit" name="new_gallery_button" value="Senden">';
        echo '<form method="post">' . $input_name . $new_gallery_button . '</form>';
        if (isset($_POST['gallery_name'])) {
            if (!empty($_POST['gallery_name'])) {
                $entry = new Entry();
                $entry->setName($_POST['gallery_name']);
                $this->storage->saveEntry($entry);
            }          
        }
    }
}