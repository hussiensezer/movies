<?php
ob_start();
$back = '';
$noNavbar = '';
include '../init.php';

checkGuest();
/*
**Notes
$url[2] = The Status Like [ Add, Delete, Active , Update];
$url[3] = The ID WHO send with parameter
*/
$url = urlParse();
$status = $url[2]; 
$id = isset($url[3]) && is_numeric($url[3]) ? intval($url[3]) : 0;

switch($status){
/************************** [ Active Case ] ***************************/
case'active':
    updateActive('roles',$id);
   
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('roles', $id);
break;

/************************** [ Updated Case ] ***************************/
case'update':
    //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // OUR POST'S
    $id     = $_POST['id'];
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = $_POST['active'];

    //THIS QUERY TO CHECK IF THERE IN DATABASE ARE ROLE WITH THIS ID
    $getRole    =  "SELECT * FROM roles WHERE id = {$id} LIMIT 1";
    $role       =  select_row($getRole);

    /* This If Condition For Check If The POST['name'] are not Equel the name of role in database
    do something else check if this exists or not*/
    $condition = $role['name'] != $name ? '|unique:roles,name' : '|exists:roles,name';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'         => 'required|numeric|exists:roles,id',
        'name'       => "required|max:50|string{$condition}",
        'active'     => "numeric|in:0,1"
    ]);
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE roles SET name = '{$name}' , active = '{$active}' WHERE id = {$id} ";
        $update = query($sql);
        $_SESSION['success'] = "Congratulation <b>Updated Are Successfully</b>";
        redirect('back');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('back');
    }
break;

/************************** [ Add Case ] ***************************/
case'add':
   //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // OUR POST'S
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = isset($_POST['active']) ? $_POST['active'] : 0 ;

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'name'   => 'required|string|min:3|max:50|unique:roles,name',
        'active' => "numeric|in:0,1"
    ]);
    
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql = "INSERT INTO roles (name,active) VALUES ('{$name}', {$active})";
        $insert = query($sql);
        $_SESSION['success'] = 'Congratulation Role Are Created Successfully';
        redirect('../../roles_view.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('back');
    }    
    

break;

/************************** [ Default Case ] ***************************/
    default:
    redirect('../../../login.php');
};

ob_end_flush();
