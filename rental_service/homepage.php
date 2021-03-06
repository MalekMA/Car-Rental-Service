<?php

session_start();
include 'format.php';
echo'
<head>
    <title>Welcome to the Car Rental Service</title>
    <link href="main.css" rel="stylesheet" />
    <meta charset="utf-8">
</head>
<body>

	
    <h1 align="center">Welcome to the Car Rental Service!</h1>
    <form action="get_by_location.php" method="post" align="center">
    <p align="center">
        Select a location
        <select name="locations">
            <option value="">Select...</option>
            <option value="North Oshawa">North Oshawa</option>
            <option value="South Oshawa">South Oshawa</option>
            <option value="Dundas">Dundas</option>
            <option value="Square One">Square One</option>
            <option value="West Taunton">West Taunton</option>
            <option value="East Taunton">East Taunton</option>
        </select>
    </p>
    
    <center><p>
        <input type="submit" name="submit" value="Search" />
    </p>
    </form>

    <input type="button" name="search" value="Search All" onclick="location.href=\'get_cars.php\'">
   
</center>
    </body>

';

if(empty($_SESSION)){
    echo '<p align="center"><input type="button" name="login" value="Login" onclick="location.href=\'login.php\'"/><p>';
    echo '<p align="center"><input type="button" name="register" value="Register" onclick="location.href=\'register.php\'"/><p>';
    echo '<p align="center">No logged in user.<p>';
}
else {
    echo '<p align="center"> Logged in as ' . $_SESSION['Email'] . '</p>';
    if($_SESSION['Email'] == "admin@rentalservice.com"){
       echo '<p align="center"><input type="button" name="admin_menu" value="Admin Menu" onclick="location.href=\'admin_menu.php\'"/></p>';
    } else {
      echo  '<p align="center"><input type="button" name="history" value="View History" onclick="location.href=\'rental_history.php\'"/></p>';
    }
    echo '<p align="center"><input type="button" name="logout" value="Logout" onclick="location.href=\'logout.php\'"/></p> ';
}
?>