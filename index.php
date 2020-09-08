
<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>Galerie</title>
        <style type="text/css">
            
        </style>
    </head>
    <body>
        <?php
            require __DIR__ . '/vendor/autoload.php';
            require_once('C:/xampp/htdocs/gallery_config.php');
            session_start();
            if (!isset($_SESSION['login'])) {
                $_SESSION['login'] = 0;
            }
            echo '<form method="post"><input type="submit" value="Ausloggen" name="logout"></form>';
            if (isset($_POST['logout'])) {
                unset($_SESSION['login']);
                header('location:http://localhost/gallery/login.php');
            }
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
            $entries = $storage->getGalleries(0);
            $view->galleryList($entries);
            if (isset($_POST['edit_button'])) {
                if ($_SESSION['login'] == 1) {
                    $filehandler = new Filehandler($storage);
                    $filehandler->editFile();    
                } else {
                    echo 'Sie müssen eingeloggt sein um Änderungen vornehmen zu können.';
                }
            }
            if (isset($_POST['submit_edit_gallery_button'])) {
                if ($_SESSION['login'] == 1) {
                    $gallery = new Entry();
                    $gallery->setID($_POST['edit_gallery_id']);
                    $gallery->setName($_POST['edit_gallery_name']);
                    $gallery->setDesc($_POST['edit_gallery_desc']);
                    $storage->editGallery($gallery);
                } else {
                    echo 'Sie müssen eingeloggt sein um Änderungen vornehmen zu können.';
                }
            }
        ?>
    </body>
</html>