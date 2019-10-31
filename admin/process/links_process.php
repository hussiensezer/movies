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
    updateActive('url_product',$id);
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('url_product', $id);
break;

/************************** [ Updated Case ] ***************************/
case'update':
    //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // OUR POST'S
    $id     = $_POST['id'];
    $link   = $_POST['link'];
    $active = $_POST['active'];
    $epis = $_POST['episode_id'];

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'         => 'required|numeric|exists:url_product,id',
        'link'       => "required|max:255|string",
        'episode_id' => "required|exists:episode_product,id",  
        'active'     => "numeric|in:0,1"
    ]);
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE url_product SET link = '{$link}' , episode_id = '{$epis}' ,active = '{$active}' WHERE id = {$id} ";
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
    $link   = $_POST['link'];
    $active = $_POST['active'];
    $epis = $_POST['episode_id'];
    
    // THIS ROW WILL BE ADD BY THE ADMIN WHO ARE ONLINE RIGHT NOW THIS WILL BE USER_ID
    $user   = $_SESSION['admin'];

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'link'    => 'required|string|min:3|max:255',
        'active'  => "numeric|in:0,1",
        'episode_id' => "required|numeric|exists:episode_product,id"
    ]);
    
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql = "INSERT INTO url_product (link,active,user_id,episode_id) VALUES ('{$link}', {$active}, {$user},{$epis} )";
        $insert = query($sql);
        $_SESSION['success'] = 'Congratulation Episode Are Created Successfully';
        redirect("../../links_view.php?id={$epis}&prod={$_POST['on']}&epi={$_POST['epi']}&idprod={$_POST['idprod']}");
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
