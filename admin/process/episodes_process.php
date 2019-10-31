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
    updateActive('episode_product',$id);
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('episode_product', $id);
break;

/************************** [ Updated Case ] ***************************/
case'update':
    //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // OUR POST'S
    $id     = $_POST['id'];
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = $_POST['active'];
    $prod = $_POST['prod_id'];

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'         => 'required|numeric|exists:episode_product,id',
        'name'       => "required|max:255|string",
        'prod_id'    => "required|exists:products,id",  
        'active'     => "numeric|in:0,1"
    ]);
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE episode_product SET name = '{$name}' , product_id = '{$prod}' ,active = '{$active}' WHERE id = {$id} ";
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
    $prod = $_POST['product_id'];

    // THIS ROW WILL BE ADD BY THE ADMIN WHO ARE ONLINE RIGHT NOW THIS WILL BE USER_ID
    $user   = $_SESSION['admin'];

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'name'    => 'required|string|min:3|max:255',
        'active'  => "numeric|in:0,1",
        'product_id' => "required|numeric|exists:products,id"
    ]);
    
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql = "INSERT INTO episode_product (name,active,user_id,product_id) VALUES ('{$name}', {$active}, {$user},{$prod} )";
        $insert = query($sql);
        $_SESSION['success'] = 'Congratulation Episode Are Created Successfully';
        redirect("../../episodes_view.php?id={$prod}");
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
