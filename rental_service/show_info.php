<?php

require_once ('/mysqli_connect.php');

if(isset($_POST['submit'])) {

    $car_selected = $_POST['car'];

    $car_id = intval($car_selected);

    $query = "SELECT * FROM owned_cars WHERE CarID = " . $car_id;

    $response = mysqli_query($dbc, $query);

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
        echo '<tr>
                <td align="left"><input type="button" name="home" value="Home" onclick="location.href=\'homepage.php\'"/></td>
                <td align="left"><input type="button" name="rent" value="Rent" onclick="location.href=\'homepage.php\'"/></td>
              </tr>';
    } else {
        echo '<p>No data recovered</p>';
    }
} else {
    echo '<p>Please select a vehicle</p><br/>';
}

?>


