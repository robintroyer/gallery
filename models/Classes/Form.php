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
            if ($_SESSION['login'] == 1) {
                if (!empty($_POST['gallery_name'])) {
                    $entry = new Entry();
                    $entry->setName($_POST['gallery_name']);
                    $entry->setDesc($_POST['gallery_desc']);
                    $this->storage->saveGallery($entry);
                }
            } else {
                echo 'Sie müssen eingeloggt sein um Änderungen vornehmen zu können.';
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
            if ($_SESSION['login'] == 1) {
                $filehandler = new Filehandler($this->storage);
                $filehandler->uploadFile();
            } else {
                echo 'Sie müssen eingeloggt sein um Änderungen vornehmen zu können.';
            }
            
        }
    }
    public function showEditGalleryForm($gallery)
    {
        echo 'Bild bearbeiten:';
        $input_title = '<input type="text" name="edit_gallery_name" value="' . $gallery->getName() . '"><br />';
        $input_desc = '<textarea type="text" name="edit_gallery_desc">' . $gallery->getDesc() . '</textarea><br />';
        $input_gallery_id = '<input type="hidden" name="edit_gallery_id" value="' . $gallery->getID() . '">';
        $hidden_input = '<input type="hidden" name="hidden_gallery">';
        $edit_button = '<input type="submit" name="submit_edit_gallery_button">';
        echo '<form method="post" enctype="multipart/form-data">' . $input_title . $input_desc
        . $input_gallery_id . $hidden_input . $edit_button . '</form>';
    }
    public function showEditImageForm($gallery_id, $images, $id)
    {
        print_r($images);

        foreach ($images as $image) {
            if ($id == $image->getID()) {
                $needed_image = $image;
                break;
            }
        }
        $image = $needed_image;

        echo 'Bild bearbeiten:';
        $input_title = '<input type="text" name="edit_title" value="' . $image->getTitle() . '"><br />';
        $input_desc = '<textarea type="text" name="edit_desc">' . $image->getDesc() . '</textarea><br />';
        $input_id = '<input type="hidden" name="edit_id" value="' . $image->getID() . '">';
        $input_gallery_id = '<input type="hidden" name="edit_gallery_id" value="' . $gallery_id . '">';
        $upload = '<input type="file" name="edit_upload" value="' . $image->getImage() . '">';
        $edit_button = '<input type="submit" name="edit_button" value="hochladen">';
        $hidden_current_image = '<input type="hidden" name="current_image" value="' . $image->getImage() . '">';
        echo '<form method="post" enctype="multipart/form-data">' . $input_title . $input_desc
        . $input_id . $input_gallery_id . $upload . $hidden_current_image . $edit_button . '</form>';
    }
    
}