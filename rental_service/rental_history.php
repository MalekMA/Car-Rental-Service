<?php
session_start();

include "format.php";

if(empty($_SESSION)){
    echo '<input type="button" name="login" value="Login" onclick="location.href=\'login.php\'" align="center"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'" align="center"/>';
    echo 'No logged in user.';
}
else {
    echo '<p align="center"> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p align="center"><input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/>
            <input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p> ';
}

if(isset($_GET['err'])){
    if($_GET['err'] == 1){
        echo '<p align="center">Review and rating entered successfully!</p>';
    }
    else if ($_GET['erro'] == 2){
        echo '<p align="center">Unable to enter review and rating</p>';
    }
}

require_once ("mysqli_connect.php");

if(isset($_POST['view'])){
    if($_POST['users'] == "All"){
        $query = "SELECT * FROM customer, rentals_history, owned_cars, locations WHERE rentals_history.CustID = customer.CustID 
                                                                                            AND owned_cars.CarID = rentals_history.CarID 
                                                                                            AND locations.LocationID = owned_cars.LocationID ";
    } else {
        $query = "SELECT * FROM customer, rentals_history, owned_cars, login_info, locations WHERE  login_info.Email='" . $_POST['users'] ."' 
                                                                                            AND customer.CustID = login_info.CustID 
                                                                                            AND rentals_history.CustID = customer.CustID 
                                                                                            AND owned_cars.CarID = rentals_history.CarID 
                                                                                            AND locations.LocationID = owned_cars.LocationID ";
    }
} else {
    $query = "SELECT * FROM customer, rentals_history, owned_cars, login_info, locations WHERE  login_info.Email='" . $_SESSION['Email'] . "' 
                                                                                            AND customer.CustID = login_info.CustID 
                                                                                            AND rentals_history.CustID = customer.CustID 
                                                                                            AND owned_cars.CarID = rentals_history.CarID 
                                                                                            AND locations.LocationID = owned_cars.LocationID ";
}

$response = mysqli_query($dbc, $query);

if($response){
    while($row = mysqli_fetch_array($response)){
        $rentalID = $row['RentalID'];
        $price = $row['Days_rented'] * $row['Price'];
       echo  '<p align="center">' . $row['FName'] . ' ' .
                     $row['LName'] . ' ' .
                     $row['Make'] . ' ' .
                     $row['Model'] . ' ' .
                     $row['Days_rented'] . ' days rented. From ' .
                     $row['Location_Name'] . '. Total cost: ' .
                     '$' . $price . '</p>';
        if($_SESSION['Email'] != "admin@rentalservice.com"){
            echo '<p align="center"><form action="enter_review.php?id=' . $rentalID . '" method="post"/>
            <b align="center">Rating: </b><input type="text" name="rating" size="1" maxlength="1"/>
            <b align="center">Review: </b><input type="text" name="review" size="20" maxlength="150"/>
            <input type="submit" name="enter_review" value="Enter Review and Rating"/></p></form>
            ';
        }
    }
} else {
    echo 'No history found.';
}