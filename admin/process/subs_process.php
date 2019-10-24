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
    updateActive('sub_categories',$id);
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('sub_categories', $id);
break;

/************************** [ Updated Case ] ***************************/
case'update':
    //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // OUR POST'S
    $id     = $_POST['id'];
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = $_POST['active'];
    $cate = $_POST['cate_id'];

    //THIS QUERY TO CHECK IF THERE IN DATABASE ARE SUB-CATE WITH THIS ID
    $getSub    =  "SELECT * FROM sub_categories WHERE id = {$id} LIMIT 1";
    $sub       =  select_row($getSub);

    /* This If Condition For Check If The POST['name'] are not Equel the name of cate in database
    do something else check if this exists or not*/
    $condition = $sub['name'] != $name ? '|unique:sub_categories,name' : '|exists:sub_categories,name';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'         => 'required|numeric|exists:sub_categories,id',
        'name'       => "required|max:100|string{$condition}",
        'cate_id'    => "required|exists:categories,id",  
        'active'     => "numeric|in:0,1"
    ]);
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE sub_categories SET name = '{$name}' ,category_id = '{$cate}' ,active = '{$active}' WHERE id = {$id} ";
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
    $cate = $_POST['cate_id'];
    // THIS ROW WILL BE ADD BY THE ADMIN WHO ARE ONLINE RIGHT NOW THIS WILL BE USER_ID
    $user   = $_SESSION['admin'];

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'name'    => 'required|string|min:3|max:100|unique:sub_categories,name',
        'active'  => "numeric|in:0,1",
        'cate_id' => "required|numeric|exists:categories,id"
    ]);
    
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql = "INSERT INTO sub_categories (name,active,user_id,category_id) VALUES ('{$name}', {$active}, {$user},{$cate} )";
        $insert = query($sql);
        $_SESSION['success'] = 'Congratulation Sub-Category Are Created Successfully';
        redirect('../../subs_view.php');
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
