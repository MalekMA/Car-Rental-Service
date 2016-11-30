<?php

session_start();

if(isset($_GET['err'])){
    if($_GET['err'] == 1){
        echo '<p>Please select pickup and return date!</p>';
    }
}

if(empty($_SESSION)){
    echo '<input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/>';
    echo 'No logged in user.';
}
else {
    echo '<p> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p> ';
}

require_once ('/mysqli_connect.php');

if(isset($_POST['submit'])) {

    $car_selected = $_POST['car'];

    $car_id = intval($car_selected);

    $query = "SELECT * FROM owned_cars WHERE CarID = " . $car_id;

    $response = mysqli_query($dbc, $query);

    if ($response) {

        while ($row = mysqli_fetch_array($response)) {
            $make = $row['Make'];
            $model = $row['Model'];
            $year = $row['Year'];
            echo
                '<p><tr><td align="left"><b>Make: </b>' . $make . '</td><br>' .
                '<td align="left"><b>Model: </b>' . $model . '</td><br>' .
                '<td align="left"><b>Year: </b>' . $year . '</td><br>' .
                '<td align="left"><b>Mileage: </b>' . $row['Mileage'] . '</td><br>' .
                '<td align="left"><b>MPG: </b>' . $row['MPG'] . '</td><br>' .
                '<td align="left"><b>Color: </b>' . $row['Color'] . '</td><br>' .
                '<td align="left"><b>Transmission: </b>' . $row['Transmission'] . '</td><br>' .
                '<td align="left"><b>Cylinders: </b>' . $row['Cylinder'] . '</td><br>' .
                '<td align="left"><b>Litres: </b>' . $row['Litre'] . '</td><br>' .
                '<td align="left"><b>Price/Day: </b>' . $row['Price'] . '</td><br>' .
                '<td align="left"><b>Number of seats: </b>' . $row['No_of_seats'] . '</td><br>' .
                '<td align="left"><b>Body type: </b>' . $row['Body_Type'] . '</td><br>';

            echo '</tr></p>';
        }

        $url = "http://api.edmunds.com/api/vehiclereviews/v2/". $make ."/". $model ."/". $year ."?sortby=thumbsUp%3AASC&pagenum=1&pagesize=10&fmt=json&api_key=upw3myjmqmc88fxwa2y2wwt8";
        $response = file_get_contents($url);
        $json = (json_decode($response, true));
        $avgRtng = $json['averageRating'];
        echo '<p><b>Average Online rating: </b>' . $avgRtng;

        $query = "SELECT Review, Rating FROM rentals_history WHERE CarID = " . $car_id;

        $response = mysqli_query($dbc, $query);

        if ($response) {

            while ($row = mysqli_fetch_array($response)){
                echo '<p><b>Review: </b>' . $row['Review'] . ' <b>Rating: </b>' . $row['Rating'];
            }
        }

        echo '
         <form action="rent.php?carid=' . $car_id . '" method="post">
         <p>
         <tr>
            <td align="left">Select Pickup Date <input type="date" name="pickup_date"></td>
            <td>Select Return Date <input type="date" name="return_date"></td>
          </tr>
        <p>
         <tr>
            <td align="left"><input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/></td>
            <td align="left"><input type="submit" name="rent" value="Rent"/></td>
         </tr>
            </form>';
    } else {
        echo '<p>No data recovered</p>';
    }
} else {
    echo '<p>Please select a vehicle</p><br/>';
}

?>


