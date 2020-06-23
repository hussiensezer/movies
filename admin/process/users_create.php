<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if($_SERVER['REQUEST_METHOD'] == 'POST'):
 // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'name'      =>  'required|string|max:100',
        'email'     =>  "required|email|max:100|unqiue:users,email",
        'pass'      =>  'required|string|min:6|max:50',
        'avatar'    =>  'requried|file',
        'role'      =>  'requried|numeric|exists:roles,id',
        'active'    =>  'numeric|in:0,1'

    ]);
    // OUR POST

    $name    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $pass    = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $avatar  = $_FILES['avatar'];
    $role_id = filter_var($_POST['role'],FILTER_SANITIZE_NUMBER_INT);
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
    
    $addUser = query($sql);
    echo $message =  "<div class='alert alert-success'> Congratultion This Users Are <b>Add Successfully </b> <div>";
    }else {
      foreach($errors as $error):
        echo "<div class='alert alert-danger'> {$error} </div>";
      endforeach;
    }
else:

echo "<div class='alert alert-danger'> You Enter By Wrong Gate Try Other One ... </div>";
endif; // End If Request Method
