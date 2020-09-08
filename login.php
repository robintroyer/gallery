<?php
    session_start();
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
        } else {
            echo 'Login fehlgeschlagen!';
        }
    }

    if (isset($_POST['guest'])) {
        $_SESSION['login'] = 0;
        header('location:http://localhost/gallery/');
    }