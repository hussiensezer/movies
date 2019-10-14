<?php
$noNavbar = '';
require_once 'init.php';

session_destroy();
session_unset();
redirect('login.php');