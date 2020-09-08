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
        echo '
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">';
        foreach ($images as $image) {
            echo '
            <div class="card" style="width: 18rem;">
                <img height="200px" src=".' . substr($image->getImage(), 23) . '" class="card-img-top" alt="'
                . $image->getTitle() . '">
                <div class="card-body">
                    <h4>' . $image->getTitle() . '</h4>
                    <p class="card-text">' . $image->getDesc() . '</p>
                </div>
            </div>';
        }
        echo '
                </div>
            </div>
        </div>';
    }
}