<?php

class View
{
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }
    public function galleryList($entries)
    {
        echo '<br />';
        echo '<form method="get">';
        foreach ($entries as $entry) {
            $button = '<input type="submit" name="galerie" value="' . $entry->getName() . '">';
            echo $button . '<br />';
        }
        echo '</form>';

        if (isset($_GET['galerie'])) {
            $this->showGallery($this->storage->getSingleEntry($_GET['galerie']));
        }
    }

    private function showGallery($gallery)
    {
        echo '<h1>' . $gallery->getName() . '</h1>';
        echo '<p>' . $gallery->getDesc() . '</p>';

        $upload = '<input type="file" name="upload">';
        $upload_button = '<input type="submit" name="upload_button" value="hochladen">';
        echo '<form method="post" enctype="multipart/form-data">' . $upload . $upload_button . '</form>';

        if (isset($_POST['upload_button'])) {
            echo 'b';
            $filehandler = new Filehandler($this->storage);
            $filehandler->uploadFile();
        }
    }
}