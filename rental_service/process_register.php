<?php

//echo '<p> Reached processing </p>';

session_start();

if(isset($_POST['register'])){

    echo 'Clicked register button';
    $required = array('Email', 'Password', 'FName', 'LName', 'Address', 'Sex', 'Date_of_birth', 'License_class', 'License_number', 'License_issue', 'License_expiry');
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if ($error) {
        echo 'error';
        header('Location:register.php?p=1');
    }
    else {
        echo ' all fields good';
        require_once ("mysqli_connect.php");

        $email = $_POST['Email'];

        $check_if_exists = "SELECT Email FROM login_info WHERE Email ='" . $email . "'";

        echo ' ' . $check_if_exists;

        $response = mysqli_query($dbc, $check_if_exists);

        if(mysqli_num_rows($response) == 0){
            echo ' account doesnt exist';

            $password = $_POST['Password'];
            $fname = $_POST['FName'];
            $lname = $_POST['LName'];
            $address = $_POST['Address'];
            $sex = $_POST['Sex'];
            $dob = $_POST['Date_of_birth'];
            $lic_class = $_POST['License_class'];
            $lic_number = $_POST['License_number'];
            $lic_issue = $_POST['License_issue'];
            $lic_exp = $_POST['License_expiry'];

            echo $dob;

            $get_max_id = "SELECT MAX(CustID) FROM login_info";

            echo ' '. $get_max_id;

            $response = mysqli_query($dbc, $get_max_id);

            $id = 0;

            if(!$response){
                echo 'Unable to get largest ID';
            } else {
                echo 'fetching id';
                $row = mysqli_fetch_row($response);
                $id = intval($row[0]) + 1;
                echo ' ' . $id;
            }

            $insert_login_info = "INSERT INTO login_info (Email, Password, CustID) VALUES (?, ?, ?)";
            $stmt_login = mysqli_prepare($dbc, $insert_login_info);
            mysqli_stmt_bind_param($stmt_login, "ssi", $email, $password, $id);
            mysqli_stmt_execute($stmt_login);

            $affected_rows = mysqli_stmt_affected_rows($stmt_login);

            echo $insert_login_info;
            echo $affected_rows;

            if($affected_rows == 1){
                echo ' inserting new info';
                $insert_customer_info = "INSERT INTO customer (CustID, FName, LName, Address, Sex, Date_of_birth, License_class, License_number, License_issue, License_expiry) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_info = mysqli_prepare($dbc, $insert_customer_info);
                mysqli_stmt_bind_param($stmt_info, "isssssssss", $id, $fname, $lname, $address, $sex, $dob, $lic_class, $lic_number, $lic_issue, $lic_exp);
                mysqli_stmt_execute($stmt_info);

                $affected_rows = mysqli_stmt_affected_rows($stmt_info);

                if($affected_rows == 1){
                    $_SESSION['Email'] = $email;
                    header('Location:homepage.php');
                } else {
                    echo 'Unable to insert';
                }

            } else {
                echo 'unable to insert login info';
            }
        } else {
            header('Location:register.php?p=2');
        }
    }
} else {
    echo 'idk';
}
?>