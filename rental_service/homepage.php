<?php

echo'
<head>
    <title>Welcome to the Car Rental Service</title>
    <link href="main.css" rel="stylesheet" />
    <meta charset="utf-8">
</head>
<body>

    <h1>Welcome to the Car Rental Service!</h1>
    
    <form action="get_by_location.php" method="post">
    <p>
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
    
    <p>
        <input type="submit" name="submit" value="Search" />
    </p>
  
    </form>

    <input type="button" name="search" value="Search All" onclick="location.href=\'get_cars.php\'">


    </body>

';

?>
