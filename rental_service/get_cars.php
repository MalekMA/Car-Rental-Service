<?php

session_start();

if(empty($_SESSION)){
    echo '<div align="right>" <input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/>';
    echo 'No logged in user.</div>';
}
else {
    echo '<div align="right>" <p> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p></div>';
}

if(isset($_GET['err'])){
    $err = $_GET['err'];

    if($err == 1){
        echo "<p>No results found.</p>";
    }

}

require_once('/mysqli_connect.php');

$subquery = "SELECT * FROM currently_rented WHERE owned_cars.CarID = currently_rented.CarID";
$query = "SELECT * FROM owned_cars, locations WHERE owned_cars.LocationID = locations.LocationID AND NOT EXISTS(" . $subquery . ")";

$response = mysqli_query($dbc, $query);

if($response){

    echo '  <div>
            <form action="get_filter_results.php?r=1" method="post">
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

            </form>
            </div>';

    echo '<form action="show_info.php" method="post">';

    while($row = mysqli_fetch_array($response)){
        $car_id = $row['CarID'];
        echo
        '<div><p>' . $row['Make'] .
        ' ' . $row['Model'] .
        ' ' . $row['Year'] .
        ' Located at: ' . $row['Location_Name'] .
        ' <input type="checkbox" name="car" value=' . $car_id;

        echo '</p>';
    }

    echo '
                <br><p><input type="submit" name="submit" value="More Info"/></p>   
            </form>
            </div>';

} else {
    echo("Could not recover data.");
}

?>
