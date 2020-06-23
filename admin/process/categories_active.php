<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'active'):
$id = isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']): 0;

ajaxActiveRow('categories', $id);

else:

echo "<div class='alert alert-danger'> Sorry Something Is Wrong </div>";
endif;
