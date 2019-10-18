<?php
ob_start();
$noNavbar = '';
require_once 'init.php';

session_destroy();
session_unset();
redirect('login.php');
ob_end_flush();
