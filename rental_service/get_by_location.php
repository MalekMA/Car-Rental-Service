<?php

session_start();

require_once('/mysqli_connect.php');

$location_selected = $_POST['locations'];

$subquery = "SELECT * FROM currently_rented WHERE owned_cars.CarID = currently_rented.CarID";
$query = "SELECT * FROM owned_cars, locations WHERE owned_cars.LocationID = locations.LocationID AND locations.Location_Name LIKE '" . $location_selected . "' AND NOT EXISTS(" . $subquery . ")";

$response = mysqli_query($dbc, $query);

if(isset($_POST['submit'])) {


    if ($response) {

        echo '
            <table align="left" cellspacing="5" cellpadding="8">
            <tr><td align = "left"><b>Make</b></td>
            <td align = "left"><b>Model</b></td>
            <td align = "left"><b>Year</b></td>
            </tr>';

        echo '<form action="show_info.php" method="post">';

        while ($row = mysqli_fetch_array($response)) {
            $car_id = $row['CarID'];
            echo
                '<tr><td align="left">' . $row['Make'] . '</td>' .
                '<td align="left">' . $row['Model'] . '</td>' .
                '<td align="left">' . $row['Year'] . '</td>' .
                '<td align="left"><input type="checkbox" name="car" value=' . $car_id .'</td>';

            echo '</tr>';


        }

        echo '
                <tr><td align="left"><input type="submit" name="submit" value="More Info"/></td></tr>    
            </form>
            </table>';


    } else {
        echo("Could not recover data.");
    }
}

?>
