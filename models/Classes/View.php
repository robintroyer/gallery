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
            echo $button;
            echo '<br />';
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
        $edit_button = '<input type="submit" name="edit_gallery_button" value="Bearbeiten">';
        $delete_button = '<input type="submit" name="delete_gallery_button" value="Löschen">';
        echo '<form method="post">' . $edit_button . $delete_button . '</form>';
        if (isset($_POST['edit_gallery_button'])) {
            $this->form->showEditGalleryForm($gallery);
        }
        if (isset($_POST['delete_gallery_button'])) {
            $this->storage->deleteGallery($gallery->getID());
        }
        $images = $this->storage->getImages($gallery->getID());
        echo '
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">';
        foreach ($images as $image) {
            echo '
            <form method="post">
                <div class="card" style="width: 18rem;">
                    <img height="200px" src=".' . substr($image->getImage(), 23) . '" class="card-img-top" alt="'
                    . $image->getTitle() . '">
                    <div class="card-body">
                        <h4>' . $image->getTitle() . '</h4>
                        <p class="card-text">' . $image->getDesc() . '</p>
                        <input type="hidden" value="' . $image->getID() . '" name="image_id">
                        <input type="submit" value="Bearbeiten" name="edit_image">
                        <input type="submit" value="Löschen" name="delete_image">
                    </div>
                </div>
            </form>';
        }
        echo '
                </div>
            </div>
        </div>';
        if (isset($_POST['edit_image'])) {
            $this->form->showEditImageForm($gallery->getID(), $images, $_POST['image_id']);
        }
        if (isset($_POST['delete_image'])) {
            $this->storage->deleteImage($_POST['image_id']);
        }
    }
}