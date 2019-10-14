<?php
$noNavbar = '';

require './init.php';
checkGuest();


// FETCH ALL THE DATA
$sql = "SELECT * FROM roles";
$roles = select_rows($sql);



