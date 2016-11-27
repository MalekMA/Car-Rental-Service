<?php

session_start();


if(isset($_GET['carid'])){
    $car_id = $_GET['carid'];

    require_once ("mysqli_connect.php");

    $query_car_info = "SELECT * FROM owned_cars WHERE CarID =" . $car_id;

    $response = mysqli_query($dbc, $query_car_info);

    if($response){
        while($row = mysqli_fetch_array($response)){
            $subtotal = $row['Price'];
            echo '<tr>
                  <td>' . $row['Make'] . '</td>
                  <td>' . $row['Model'] . '</td>
                  <td>' . $row['Color'] . '</td>
                  <td>' . $row['Price'] . '</td>';
        }


    }
}

