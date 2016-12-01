<?php

session_start();

include "format.php";
require_once ("mysqli_connect.php");

$query = "SELECT Email FROM login_info";

$response = mysqli_query($dbc, $query);

if($response){

    echo '
    <form action="rental_history.php" method="post" align="center">
    <select name="users">
        <option value = "" > Select...</option >
        <option value = "All" >All</option >';
    while($row = mysqli_fetch_array($response)) {
        echo '<option value = "'.$row['Email'] .'" >' . $row['Email'] .'</option >';

        }
        echo '</select>
        <input type="submit" name="view" value="View History"/>
        </form>';
}

echo '<p align="center"><input type="button" name="add" value="Add Vehicle" onclick="location.href=\'add_vehicle.php\'"/>
        <input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/></p>'

?>