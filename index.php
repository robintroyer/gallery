
<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <title>Galerie</title>
        <style type="text/css">
            .gallery-image {
                height: 200px;
            }
        </style>
    </head>
    <body>

        <?php
            require __DIR__ . '/vendor/autoload.php';
            require_once('C:/xampp/htdocs/gallery_config.php');

            $storage = new Database();
            $configDB = new stdClass();
            $configDB->server = $DB_HOST;
            $configDB->username = $DB_USER;
            $configDB->password = $DB_PASS;
            $configDB->database = $DB_NAME;
            $storage->initialize($configDB);
            $config = new stdClass();
            $config->storage = $storage;
            $form = new Form($config);
            $view = new View($storage, $form);


            $form->newGalleryForm();

            $entries = $storage->getGalleries();
            
            $view->galleryList($entries);

            // $storage->a
            // print_r($_POST);
            if (isset($_POST['edit_button'])) {
                $filehandler = new Filehandler($storage);
                $filehandler->editFile();
            }
            if (isset($_POST['submit_edit_gallery_button'])) {
                // $this->storage->editGallery();
                $gallery = new Entry();
                $gallery->setID($_POST['edit_gallery_id']);
                $gallery->setName($_POST['edit_gallery_name']);
                $gallery->setDesc($_POST['edit_gallery_desc']);
                $storage->editGallery($gallery);
            }


        ?>

    </body>
</html>