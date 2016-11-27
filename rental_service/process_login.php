<?php

session_start();

if(isset($_POST['login'])){

    $required = array('email', 'password');
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if ($error) {
        header('Location:login.php?p=1');
    }
    else {
        echo 'in here';
        require_once('mysqli_connect.php');

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT Email, Password FROM login_info WHERE Email = '" . $email . "' AND Password = '" . $password . "'";

        $response = mysqli_query($dbc, $query);

        if ($response) {
            echo ' in here 2';
            while ($row = mysqli_fetch_array($response)) {
                if ($row['Email'] == $email && $row['Password'] == $password) {
                    echo ' in here 4';
                    echo 'Login Successful';
                    $_SESSION['Email'] = $email;
                    header('Location:homepage.php');
                }
            }
            header('Location:login.php?p=2');
        }
    }
}