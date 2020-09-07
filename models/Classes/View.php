<?php

class View
{
    private $storage;
    private $form;

    public function __construct($storage, $form)
    {
        $this->storage = $storage;
        $this->form = $form;
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

        $this->form->newImageForm($gallery->getID());
        $images = $this->storage->getImages($gallery->getID());
        foreach ($images as $image) {
            // echo $image->getImage() . '<br />';
            // echo '.' . substr($image->getImage(), 23) . '<br />';
            // print_r($image);
            // echo '<img src="' . $image->getImage() . '">';
            echo '<img class="gallery-image" src=".' . substr($image->getImage(), 23) . '">';
        }
    }
}