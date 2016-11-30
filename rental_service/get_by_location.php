<?php

session_start();

if(empty($_SESSION)){
    echo '<div><input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/></div>';
    echo 'No logged in user.';
}
else {
    echo '<div><p> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p></div> ';
}

if(isset($_GET['err'])){
    $err = $_GET['err'];

    if($err == 1){
        echo "<p>No results found.</p>";
    }

}
if(isset($_GET['loc'])){
    $location_selected = $_GET['loc'];
    $location_selected = urldecode($location_selected);
}
else {
    $location_selected = $_POST['locations'];
}

require_once("mysqli_connect.php");

$subquery = "SELECT * FROM currently_rented WHERE owned_cars.CarID = currently_rented.CarID";
$query = "SELECT * FROM owned_cars, locations WHERE owned_cars.LocationID = locations.LocationID AND locations.Location_Name LIKE '" . $location_selected . "' AND NOT EXISTS(" . $subquery . ")";

$response = mysqli_query($dbc, $query);

if(isset($_POST['submit']) || isset($_GET['loc'])) {


    if ($response) {

        echo '
            <div>
            <form action="get_filter_results.php?r=2&loc=' .$location_selected .'" method="post">
            <tr align="left">Colour
                <select name="colour">
                    <option value=""></option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Grey">Grey</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Silver">Silver</option>
                </select>
                
                
                Body Type
                <select name="body">
                    <option value=""></option>
                    <option value="SUV">SUV</option>
                    <option value="Sedan">Sedan</option>
                    <option value="Coupe">Coupe</option>
                    <option value="Truck">Truck</option>
                    <option value="Hatchback">Hatchback</option>
                </select>
                
                
                Number of Seats
                <select name="num_seats">
                    <option value=""></option>
                    <option value="2">Two</option>
                    <option value="5">Five</option>
                    <option value="7">Seven</option>
                </select>
               
                
            </tr>
            
           
            <input type="submit" name="filter" value="Filter" />
            
            </form></div>';

        echo '<div><form action="show_info.php" method="post">';

        while ($row = mysqli_fetch_array($response)) {
            $car_id = $row['CarID'];
            echo
                '<p>' . $row['Make'] .
                ' ' . $row['Model'] .
                ' ' . $row['Year'] .
                ' <input type="checkbox" name="car" value=' . $car_id;

            echo '</p>';


        }

        echo '
                <br><p><input type="submit" name="submit" value="More Info"/></p>    
            </form></div>';


    } else {
        echo("Could not recover data.");
    }
}



?>
