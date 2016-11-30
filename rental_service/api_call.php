<?php

//TESTER CLASS FOR API CALLS :: IGNORE!!!

$make = "Audi";
$model = "A3";
$year = "2016";

$response = file_get_contents('http://api.edmunds.com/api/vehiclereviews/v2/honda/civic/2013?sortby=thumbsUp%3AASC&pagenum=1&pagesize=10&fmt=json&api_key=upw3myjmqmc88fxwa2y2wwt8');



$json = (json_decode($response, true));

var_dump(json_decode($response, true));

echo $json['averageRating'];