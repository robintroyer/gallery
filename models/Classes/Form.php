<?php

class Form {
    public function newGalleryForm()
    {
        $input_name = '<input type="text" name="gallery_name">';
        $new_gallery_button = '<input type="submit" name="new_gallery_button" value="Senden">';
        echo '<form method="post">' . $input_name . $new_gallery_button . '</form>';
    }
}