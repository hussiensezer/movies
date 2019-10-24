<?php

/* DEFINE CONSTANTS */
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'movies');

// THE CONNECTION TO DATABASE
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// TO SUPPORT ARABIC LANGUAGE
mysqli_query($connection,"SET NAMES 'utf8'");
mysqli_query($connection,'SET CHARACTER SET utf8');

// CHECK IF ARE CONNECTED TO DATABASE OR NOT
//echo $check = $connection ? 'You Are Connected To Data Base' : 'No Connection';