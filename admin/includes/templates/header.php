<?php
// FETCH THE DATE OF THE ADMIN WHO 
if(isset($_SESSION['admin'])){

    $sql = "SELECT * FROM users WHERE id = {$_SESSION['admin']} LIMIT 1";
    $user = select_row($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($pageTitle) ? $pageTitle: 'No Title';?></title>
    <!-- OUR CSS FILES -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
