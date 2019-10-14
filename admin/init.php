<?php

require_once "includes/functions/kernel.php";



 	$tpl = 'includes/templates/';  // Template Directory
    $css = 'assets/css/';
    $js = 'assets/js/';
    $img = 'assets/images/';
	



//     // Include The Important Files

     include $tpl . 'header.php'; // For Header



 // Include Navbar On All Pages Expect The One With $noNavBar Vairable

if(!isset($noNavbar)){
include $tpl . 'navbar.php'; // For Navbar
}
