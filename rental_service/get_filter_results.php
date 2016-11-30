<?php
session_start();

if(empty($_SESSION)){
    echo '<div><input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/>';
    echo '<input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/>';
    echo 'No logged in user.</div>';
}
else {
    echo '<div><p> Logged in as ' . $_SESSION['Email'] . '</p>';
    echo '<p><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p></div>';
}

if(isset($_GET['r'])){
    if($_GET['r'] == 2){
        $ref = "get_by_location.php";
    }
    if($_GET['r'] == 1){
        $ref = "get_cars.php";
    }
}

if(isset($_GET['loc'])){
    $location = $_GET['loc'];
    $location = urldecode($location);
    $query = "SELECT * FROM owned_cars, locations WHERE locations.Location_Name = '" . $location . "' AND owned_cars.LocationID = locations.LocationID";
}
else {
    $query = "SELECT * FROM owned_cars, locations WHERE locations.LocationID = owned_cars.LocationID";
}


if($_POST['filter'] != "") {
    if ($_POST['colour'] != "") {
        $colour_chosen = $_POST['colour'];
        $query = $query . " AND Color='" . $colour_chosen . "'";
        if ($_POST['body'] != "") {
            $body_chosen = $_POST['body'];
            $query = $query . " AND Body_type ='" . $body_chosen . "'";
            if ($_POST['num_seats'] != "") {
                $num_seats_chosen = $_POST['num_seats'];
                $query = $query . " AND No_of_seats =" . intval($num_seats_chosen);
            }
        } else if ($_POST['num_seats'] != "") {
            $num_seats_chosen = $_POST['num_seats'];
            $query = $query . " AND No_of_seats =" . intval($num_seats_chosen);
        }
    } else if ($_POST['body'] != "") {
        $body_chosen = $_POST['body'];
        $query = $query . " AND Body_Type='" . $body_chosen . "'";
        if ($_POST['num_seats'] != "") {
            $num_seats_chosen = $_POST['num_seats'];
            $query = $query . " AND No_of_seats =" . intval($num_seats_chosen);
        }
    } else if ($_POST['num_seats'] != "") {
        $num_seats_chosen = $_POST['num_seats'];
        $query = $query . " AND No_of_seats=" . intval($num_seats_chosen);
    } else {
        header('Location:'.$ref.'?err=1&loc='.$location);
    }

    require_once ('mysqli_connect.php');

    $response = mysqli_query($dbc, $query);

    if(mysqli_num_rows($response) == 0){
        header('Location:'.$ref.'?err=1&loc='.$location);
    } else {
        echo '<form action="show_info.php" method="post">';

        while ($row = mysqli_fetch_array($response)) {
            $car_id = $row['CarID'];
            echo
                '<div><p>' . $row['Make'] .
                ' ' . $row['Model']  .
                ' ' . $row['Year'] .
                ' Located at: ' . $row['Location_Name'] .
                ' <input type="checkbox" name="car" value=' . $car_id;

            echo '</p>';


        }

        echo '
                <br><p><input type="submit" name="submit" value="More Info"/></p>    
            </form>
            </div>';
    }
}


?>