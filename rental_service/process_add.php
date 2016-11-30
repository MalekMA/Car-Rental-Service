<?php

if(isset($_POST['add'])) {

    require_once ("mysqli_connect.php");

    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $year = $_POST['Year'];
    $body = $_POST['Body_Type'];

    $url = "http://api.edmunds.com/api/vehicle/v2/" . $make . "/" . $model . "/" . $year . "/styles?state=used&category=". $body ."&view=full&fmt=json&api_key=upw3myjmqmc88fxwa2y2wwt8";

    echo $url . '<br>';

    $response = file_get_contents($url);
    $json = (json_decode($response, true));

    if(intval($json['stylesCount']) > 0) {

        $cylinder = intval($json['styles'][0]['engine']['cylinder']);
        $litre = floatval($json['styles'][0]['engine']['size']);
        $mpg = floatval($json['styles'][0]['MPG']['city']);
        $transmission = $json['styles'][0]['transmission']['transmissionType'];

        $mileage = floatval($_POST['Mileage']);
        $colour = $_POST['Colour'];
        $price = floatval($_POST['Price']);
        $seats = intval($_POST['No_of_seats']);

        $locID = 0;
        $get_loc_id = "SELECT LocationID FROM locations WHERE Location_Name='" . $_POST['Location'] . "'";
        $response = mysqli_query($dbc, $get_loc_id);
        if (!$response) {
            echo 'Unable to get Loc ID';
        } else {
            echo 'fetching id';
            $row = mysqli_fetch_row($response);
            $locID = intval($row[0]);
            echo ' ' . $locID;
        }

        $carID = 0;
        $get_max_id = "SELECT MAX(CarID) FROM owned_cars";
        $response = mysqli_query($dbc, $get_max_id);
        if (!$response) {
            echo 'Unable to get largest ID';
        } else {
            echo 'fetching id';
            $row = mysqli_fetch_row($response);
            $carID = intval($row[0]) + 1;
            echo ' ' . $carID;
        }

        echo $carID. ' ' .$locID. ' ' . $make. ' ' . $model. ' ' . $year. ' ' . $mileage. ' ' . $mpg. ' ' . $colour. ' ' . $transmission. ' ' . $cylinder. ' ' . $litre. ' ' . $price. ' ' . $seats. ' ' . $body. ' ';

        $insert_new_vehicle = "INSERT INTO owned_cars (CarID, LocationID, Make, Model, Year, Mileage, MPG, Color, Transmission, Cylinder, Litre, Price, No_of_seats, Body_Type) 
                                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($dbc, $insert_new_vehicle);
        mysqli_stmt_bind_param($stmt_insert, "iissiddssiddis", $carID, $locID, $make, $model, $year, $mileage, $mpg, $colour, $transmission, $cylinder, $litre, $price, $seats, $body);
        mysqli_stmt_execute($stmt_insert);

        $affected_rows = mysqli_stmt_affected_rows($stmt_insert);

        if ($affected_rows == 1) {
            header('Location:add_vehicle.php?r=1');
        } else {
            header('Location:add_vehicle.php?r=2');
        }
    } else {
        echo 'Unable to get car details from API.';
    }
}
?>