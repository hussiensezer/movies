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
$id = isset($url[3]) && is_numeric($url[3])? $url[3] : NULL;

switch($status){
/************************** [ Active Case ] ***************************/
case'active':
    updateActive('users',$id);
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('users', $id);
break;

/************************** [ Updated Case ] ***************************/
case'update':
    //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    //THIS QUERY TO CHECK IF THERE IN DATABASE ARE ROLE WITH THIS ID
    $user    = fetchForEdit('users',$_POST['id']);

    /* This If Condition For Check If The POST['name'] are not Equel the name of role in database
    do something else check if this exists or not*/
    $condition = $user['email'] != $_POST['email']? '|unique:users,email' : '|exists:users,email';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'        =>  'required|numeric|exists:users,id',
        'name'      =>  'required|string|max:100',
        'email'     =>  "required|email|max:100{$condition}",
        'pass'      =>  'string|min:6|max:50',
        'avatar'    =>  'rquired|file',
        'role_id'   =>  'reqired|exists:roles,id',
        'active'    =>  'numeric|in:0,1'

    ]);

    // OUR POST
    $id      = $_POST['id'];
    $name    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $pass    = isset($_POST['pass']) && !empty($_POST['pass'])? password_hash($_POST['pass'], PASSWORD_DEFAULT) : $user['password'];
    $avatar  = $_FILES['avatar'];
    $role_id = filter_var($_POST['role'],FILTER_SANITIZE_NUMBER_INT);
    $active  = $_POST['active'];
    
    //CHECK IF THE FILE ARE NOT EMPTY IS MEAN THE USER UPLOAD A NEW AVATAR WILL REMOVE THE OTHER AVATAR
    // AND UPLOAD THE NEW AVATAR BY FUNCTION
    //ELSE
    //THE OLD AVATAR WILL STAY
    $avatarName = checkAvatar($_FILES['avatar']['name'],$user['avatar'], $avatar, 2, 'avatars');

    
    // FUNCTION TO MAKE UPLOAD THE AVATAR TO THE PATH AND

    // CHECK IF THERE IS ERORRS IN VALIDATOR
    if(empty($errors)){
        $sql = "UPDATE users SET 
                                name         = '{$name}' ,
                                email        = '{$email}',
                                password     = '{$pass}',
                                avatar       = '{$avatarName}',
                                role_id      = '{$role_id}',
                                active       = '{$active}'
                            WHERE
                                id = {$id}
                            ";
        $updateUser = query($sql);
        $_SESSION['success'] = "Congratualion  User Row Are <b>Updated Successfuly</b>";
        redirect('back');
    }else {
        $_SESSION['errors'] = $errors;
        redirect('back');
    }
print_r($errors);

break;

/************************** [ Add Case ] ***************************/
case'add':
   //CHECK IF THE VISTITOR ARE COMING FROM REQUEST_METHOD FROM FORM NOT JUST CHECK;
    $checkRequest = $_SERVER['REQUEST_METHOD'] != 'POST' ? redirect('../../../login.php') : '';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'name'      =>  'required|string|max:100',
        'email'     =>  "required|email|max:100|unqiue:users,email",
        'pass'      =>  'required|string|min:6|max:50',
        'avatar'    =>  'requried|file',
        'role_id'   =>  'reqired|exists:roles,id',
        'active'    =>  'numeric|in:0,1'

    ]);
    // OUR POST

    $name    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $pass    = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $avatar  = $_FILES['avatar'];
    $role_id = $_POST['role'];
    $active = isset($_POST['active']) ? $_POST['active'] : 0 ;

    //I USE FUNCTION TO MAKE VALIDATOR IN FILE IF THERE ERROR WILL PASS IN SESSION['errors'] THE ERROR
    // IF NO ERRORS WILL UPLOAD THE FILE TO THE STATION AND RETURN THE NAME OF FILE
    $avatarName = uploadAvatar($avatar,2,'avatars');
    // CHECK IF THERE IS ERORRS IN VALIDATOR WILL SEND THE DATA TO DATABASE    
    if(empty($errors)) {
        $sql = "INSERT INTO users   (
                                    name,
                                    email,
                                    password,
                                    avatar,
                                    active,
                                    role_id
                                    )
                            VALUES  (
                                    '{$name}',
                                    '{$email}',
                                    '{$pass}',
                                    '{$avatarName}',
                                    '{$active}',
                                    '$role_id'
                                    )
                                ";
    echo $sql;
    $addUser = query($sql);
    $_SESSION['success'] = "Congratultion This Users Are <b>Add Successfully</b> ";
    redirect('../../users_view.php');
    }else {
        $_SESSION['errors'] = $errors;
        redirect('back');
    }
break;

/************************** [ Default Case ] ***************************/
    default:
redirect('../../../login.php');
};

ob_end_flush();
