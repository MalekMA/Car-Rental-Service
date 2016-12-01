<?php

session_start();

include "format.php";

if(isset($_GET['r'])){
    if($_GET['r'] == 1){
        echo '<p align="cetner">Vehicle entered successfully!</p>';
    }
    else if($_GET['r'] == 2){
        echo '<p align="center">Vehicle was not added.</p>';
    }
}



if($_SESSION['Email'] == "admin@rentalservice.com"){
    echo '
    <form action="process_add.php" method="post" align="center"/>
    <p><b>Make: </b><input type="text" name="Make" size="15"/></p>
    <p><b>Model: </b><input type="text" name="Model" size="15"/></p>
    <p><b>Year: </b><input type="text" name="Year" size="4" maxlength="4"/></p>
    <p><b>Mileage: </b><input type="text" name="Mileage" size="15"/></p>
    <p><b>Colour: </b><input type="text" name="Colour" size="15"/></p>
    <p><b>Body Type: </b><input type="text" name="Body_Type" size="15"/></p>
    <p><b>Number of seats: </b><input type="text" name="No_of_seats" size="2" maxlength="2"/></p>
    <p><b>Price/Day: </b><input type="text" name="Price" size="3"/></p>
    <p><b>Location: </b><input type="text" name="Location" size="10"/></p>
    <p><input type="submit" name="add" value="Add Vehicle"/></p>
    <input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/>
    </form>
    ';
} else {
    echo 'Illegal Access';
}

if(empty($_SESSION)){
    echo '<input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/>';
    echo 'No logged in user.';
}
else {
    echo '<p align="center"> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p align="cetner"><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p> ';
}