<?php
ob_start();
$noNavbar = '';
require_once 'init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
     // VALIDATOR OF DATA   
    $errors = validator($_POST,[
        'email'     =>  'required|email|max:100|exists:users,email',
        'password'  =>   'required|string|min:6|max:100'
    ]);

    if(empty($errors)){
        $email = $_POST['email'];
        $pass  = $_POST['password'];

        // CHECK IF THIS POST['EMAIL'] ARE EXISTS IN DATABASE AND THE ROLE ARE EQUEL 1 = 'ADMIN';
        $sql ="SELECT id,name,password FROM users WHERE email = '{$email}' AND role_id = 1 LIMIT 1";
        
        $admin =  select_row($sql);
        if(!empty($admin)) {
            // TO DECRYPTION THE PASSWORD TO BE MATCHING WITH MY ENTERY PASSWORD
            if(password_verify($pass,$admin['password'])){
                $_SESSION['admin']    = $admin['id'];
                $_SESSION['success']  = 'Welcome ' . $admin['name'] . ' Back';
                redirect('index.php'); 
            }else {
                $_SESSION['error'] = 'Wrong Password Try Again';
                redirect('login.php');
            }
        }else {
            $_SESSION['error'] = "You Dont Have The Permission To Come Here";
            redirect('login.php');
        }
        
    }else {
        // SESSION FOR ERRORS
        $_SESSION['errors'] = $errors;
        redirect('login.php');
    }
    
}else {
    $_SESSION['error'] = "You Visit It Directely";
    redirect('login.php');
}
ob_end_flush();
