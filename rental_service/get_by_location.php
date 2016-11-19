<?php

require_once('/mysqli_connect.php');

$location_selected = $_POST['locations'];

$query = "SELECT * FROM owned_cars, locations WHERE owned_cars.LocationID = locations.LocationID AND locations.Location_Name LIKE '" . $location_selected . "'";

$response = mysqli_query($dbc, $query);

if(isset($_POST['submit'])) {


    if ($response) {

        echo '<table align="left" cellspacing="5" cellpadding="8">

    <tr><td align = "left"><b>Make</b></td>
    <td align = "left"><b>Model</b></td>
    <td align = "left"><b>Year</b></td>
    <td align = "left"><b>Mileage</b></td>
    <td align = "left"><b>MPG</b></td>
    <td align = "left"><b>Colour</b></td>
    <td align = "left"><b>Transmission</b></td>
    <td align = "left"><b>Cylinder</b></td>
    <td align = "left"><b>Litre</b></td>
    <td align = "left"><b>Price</b></td>
    <td align = "left"><b>Number of Seats</b></td>
    <td align = "left"><b>Body Type</b></td>
    
    </tr>';

        while ($row = mysqli_fetch_array($response)) {
            echo
                '<tr><td align="left">' . $row['Make'] . '</td>' .
                '<td align="left">' . $row['Model'] . '</td>' .
                '<td align="left">' . $row['Year'] . '</td>' .
                '<td align="left">' . $row['Mileage'] . '</td>' .
                '<td align="left">' . $row['MPG'] . '</td>' .
                '<td align="left">' . $row['Color'] . '</td>' .
                '<td align="left">' . $row['Transmission'] . '</td>' .
                '<td align="left">' . $row['Cylinder'] . '</td>' .
                '<td align="left">' . $row['Litre'] . '</td>' .
                '<td align="left">' . $row['Price'] . '</td>' .
                '<td align="left">' . $row['No_of_seats'] . '</td>' .
                '<td align="left">' . $row['Body_Type'] . '</td>';

            echo '</tr>';
        }

        echo '</table>';

    } else {
        echo("Could not recover data.");
    }
}

?>
