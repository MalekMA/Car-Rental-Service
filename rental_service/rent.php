<?php

session_start();


if(isset($_GET['carid'])){
    if(isset($_POST['pickup_date']) && isset($_POST['return_date'])) {

        require_once("mysqli_connect.php");

        $p = new DateTime($_POST['pickup_date']);
        $r = new DateTime($_POST['return_date']);
        $days_rented = intval($r->diff($p)->format("%a"));
        echo $days_rented . '<br>';

        $car_id = $_GET['carid'];
        $pickup = $_POST['pickup_date'];
        $return = $_POST['return_date'];

        $get_cust_id = "SELECT CustID FROM login_info WHERE Email='" . $_SESSION['Email'] . "'";
        $response = mysqli_query($dbc, $get_cust_id);

        $cust_id = 0;
        if($response){
            while($row = mysqli_fetch_array($response)){
                $cust_id = intval($row['CustID']);
                echo $cust_id. '<br>';
            }
        } else {
            echo 'Unable to recover ID';
        }

        $get_max_rentalID = "SELECT MAX(RentalID) FROM rentals_history";
        $response = mysqli_query($dbc, $get_max_rentalID);

        $rental_id = 0;
        if($response){
            while($row = mysqli_fetch_array($response)){
                $rental_id = intval($row['MAX(RentalID)']) + 1;
                echo $rental_id. '<br>';
            }
        } else {
            echo 'Unable to recover ID';
        }

        $insert_currently_rented = "INSERT INTO currently_rented (RentalID, CarID, CustID, Pickup_Date, Return_Date) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($dbc, $insert_currently_rented);
        mysqli_stmt_bind_param($stmt_insert, "sssss", $rental_id, $car_id, $cust_id, $pickup, $return);
        mysqli_stmt_execute($stmt_insert);

        $affected_rows = mysqli_stmt_affected_rows($stmt_insert);

        echo $insert_currently_rented;
        echo $affected_rows;

        if($affected_rows == 1) {
            $insert_rental_history = "INSERT INTO rentals_history (RentalID, CarID, CustID, Pickup_Date, Days_rented) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($dbc, $insert_rental_history);
            mysqli_stmt_bind_param($stmt_insert, "sssss", $rental_id, $car_id, $cust_id, $pickup, $days_rented);
            mysqli_stmt_execute($stmt_insert);

            $affected_rows = mysqli_stmt_affected_rows($stmt_insert);
            if($affected_rows == 1){
                header('Location:rental_history.php');
            } else {
                echo 'Error occured during attempt to rent.';
            }
        } else {
            echo 'Error occured while attempting to rent. 1';
        }
    } else {
        header('Location:show_info.php?err=1');
    }


}

