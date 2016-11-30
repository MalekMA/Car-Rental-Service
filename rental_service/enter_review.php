<?php

if(isset($_POST['enter_review'])){
    require_once ("mysqli_connect.php");
    $rentalID = $_GET['id'];
    $rating = intval($_POST['rating']);
    $review = $_POST['review'];

    $query = "UPDATE rentals_history SET Review='" . $review . "', Rating=" . $rating . " WHERE rentals_history.RentalID=" . $rentalID;

    $response = mysqli_query($dbc, $query);
    if($response){
        header('Location:rental_history.php?err=1');
    } else {
        header('Location:rental_history.php?err=2');
    }
}