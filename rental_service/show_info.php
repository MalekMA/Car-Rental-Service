<?php

session_start();

require_once ('/mysqli_connect.php');

if(isset($_POST['submit'])) {

    $car_selected = $_POST['car'];

    $car_id = intval($car_selected);

    $query = "SELECT * FROM owned_cars WHERE CarID = " . $car_id;

    $response = mysqli_query($dbc, $query);

    if ($response) {

        while ($row = mysqli_fetch_array($response)) {
            echo
                '<p><tr><td align="left"><b>Make: </b>' . $row['Make'] . '</td><br>' .
                '<td align="left"><b>Model: </b>' . $row['Model'] . '</td><br>' .
                '<td align="left"><b>Year: </b>' . $row['Year'] . '</td><br>' .
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

        echo '
         <form action="rent.php" method="post"
         <p>
         <tr>
            <td align="left">Select Pickup Date <input type="date" name="pickup_date"></td>
            <td>Select Return Date <input type="date" name="return_date"></td>
          </tr>
        <p>
         <tr>
            <td align="left"><input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/></td>
            <td align="left"><input type="button" name="rent" value="Rent" onclick="location.href=\'rent.php?carid=' . $car_id . '\'" /></td>
         </tr>
            </form>';
    } else {
        echo '<p>No data recovered</p>';
    }
} else {
    echo '<p>Please select a vehicle</p><br/>';
}

?>


