<?php
    session_start();
    // unset($_POST['username']);
    // unset($_POST['password']);
    // unset($_POST['guest']);

    echo '<form method="post">Benutzername:<br /><input type="text" name="username"><br />
    Passwort:<br /><input type="text" name="password"><input type="submit"></form>';

    echo '<form method="post"><input type="submit" name="guest" value="Gastzugang"></form>';

    $username = 'robin_troyer';
    $password = 'RT123';
    
    if (
        isset($_POST['username'])
        && isset($_POST['password'])
    ) {
        
        if (
            $_POST['username'] === $username
            && $_POST['password'] === $password
        ) {
            echo 'Login erfolgreich!';
            $_SESSION['login'] = 1;
            header('location:http://localhost/gallery/');
            // echo '<script type="text/javascript">window.location="http://localhost/gallery/";</script>';
        } else {
            echo 'Login fehlgeschlagen!';
        }
    }

    if (isset($_POST['guest'])) {
        $_SESSION['login'] = 0;
        header('location:http://localhost/gallery/');
    }