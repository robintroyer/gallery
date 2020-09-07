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
}