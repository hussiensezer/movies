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
    updateActive('products',$id);
break;

/************************** [ Remove Case ] ***************************/
case'delete':
    deleteRow('products', $id);
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
echo    $getProd    =  "SELECT * FROM products WHERE id = $id LIMIT 1";
    $prod       =  select_row($getProd);

    /* This If Condition For Check If The POST['name'] are not Equel the name of cate in database
    do something else check if this exists or not*/
    $condition = $prod['name'] != $name ? '|unique:products,name' : '|exists:products,name';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'name'      => "required|string|min:3|max:100{$condition}",
        'active'    => "numeric|in:0,1",
        'id'        =>  'required|numeric|exists:products,id',
        'year'      => "required|numeric",
        'rate'      => "required|numeric",
        'cate_id'   => "required|numeric|exists:sub_categories,id",
        'type'      => "required|string",
        'tags'      => 'required|string',
        'desc'      => 'required|string'
    ]);
    // OUR POST'S
    $active = isset($_POST['active']) ? $_POST['active'] : 0 ;
    $year   = filter_var($_POST['year'],FILTER_SANITIZE_NUMBER_INT);
    $rate   = $_POST['rate'];
    $cate   = filter_var($_POST['cate_id'],FILTER_SANITIZE_NUMBER_INT);
    $type   = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    $poster = $_FILES['poster'];
    $tags   = $_POST['tags'];
    $desc   = $_POST['desc'];

    // EMPTY VARIABLE TO ASSIGN THEM AFTER CHECK IF THE POST OF TYPE ARE MOVIE OR SERIES
    $movie  = '';
    $series = '';

    // CHECK IF THE POST OF TYPE ARE WHAT MOVIE OR SERIES TO ASSIGN
    if($_POST['type'] == 'movie') {
        // THIS WILL BE MOVIE
        $movie      = 1;
        $series     = 0;
    }else{
        // THIS WILL SERIES
        $movie      = 0;
        $series     = 1;
    }

    //CHECK IF THE FILE ARE NOT EMPTY IS MEAN THE USER UPLOAD A NEW AVATAR WILL REMOVE THE OTHER AVATAR
    // AND UPLOAD THE NEW AVATAR BY FUNCTION
    //ELSE
    //THE OLD AVATAR WILL STAY
    /*
    ** $fileName = THE NAME OF FILES  => [$_FILE['avatar']['name']]
    ** $checkOn = THE AVATAR NAME IN DATABASE => [ $user['avatar'], $course['avatar'] ]
    ** $fileData = THE ARRAY OF $_FILES,
    ** $size = THE MAXIMUM OF SIZE BY [ MB ] YOU NEED TO UPLOAD;
    ** $path = THE FILE WILL SAVE AVATAR THERE LIKKE => ['avatars, poster', 'cast', 'shots'] file
    */
    $logo = checkAvatar($_FILES['poster']['name'],$prod['avatar'],$poster,4, 'posters');

    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE products SET
                                        name = '{$name}' ,
                                        description = '{$desc}',
                                        year = '{$year}',
                                        rate = '{$rate}',
                                        avatar = '{$logo}',
                                        tags = '{$tags}',
                                        movie = '{$movie}',
                                        series = '{$series}',
                                        sub_category_id = '{$cate}',
                                        active = '{$active}'
                                WHERE 
                                        id = {$id}  ";
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


    // THIS ROW WILL BE ADD BY THE ADMIN WHO ARE ONLINE RIGHT NOW THIS WILL BE USER_ID
    $user   = $_SESSION['admin'];
    
    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors =  validator($_POST,[   
        'name'      => 'required|string|min:3|max:100|unique:products,name',
        'active'    => "numeric|in:0,1",
        'year'      => "required|numeric",
        'rate'      => "required|numeric",
        'cate_id'   => "required|numeric|exists:sub_categories,id",
        'type'      => "required|string",
        'tags'      => 'required|string',
        'desc'      => 'required|string'
    ]);

    // OUR POST'S
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = isset($_POST['active']) ? $_POST['active'] : 0 ;
    $year   = filter_var($_POST['year'],FILTER_SANITIZE_NUMBER_INT);
    $rate   = $_POST['rate'];
    $cate   = filter_var($_POST['cate_id'],FILTER_SANITIZE_NUMBER_INT);
    $type   = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    $poster = $_FILES['poster'];
    $tags   = $_POST['tags'];
    $desc   = $_POST['desc'];

    // EMPTY VARIABLE TO ASSIGN THEM AFTER CHECK IF THE POST OF TYPE ARE MOVIE OR SERIES
    $movie  = '';
    $series = '';

    // CHECK IF THE POST OF TYPE ARE WHAT MOVIE OR SERIES TO ASSIGN
    if($_POST['type'] == 'movie') {
        // THIS WILL BE MOVIE
        $movie      = 1;
        $series     = 0;
    }else{
        // THIS WILL SERIES
        $movie      = 0;
        $series     = 1;
    }

    //I USE FUNCTION TO MAKE VALIDATOR IN FILE IF THERE ERROR WILL PASS IN SESSION['errors'] THE ERROR
    // IF NO ERRORS WILL UPLOAD THE FILE TO THE STATION AND RETURN THE NAME OF FILE
    $posterName = uploadAvatar($poster,4,'posters');

    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql = "INSERT INTO products (
                                        name,
                                        description,
                                        year,
                                        rate,
                                        avatar,
                                        tags,
                                        movie,
                                        series,
                                        active,
                                        user_id,
                                        sub_category_id
                                    )
                            VALUES  (
                                        '{$name}',
                                        '{$desc}',
                                        '{$year}',
                                        '{$rate}',
                                        '{$posterName}',
                                        '{$tags}',
                                        '{$movie}',
                                        '{$series}',
                                        '{$active}',
                                        '{$user}',
                                        '{$cate}'
                                    )
                                    ";
        $insert = query($sql);
            // WE GONA ADD THE ROW OF VIEW TO COUNT THE VIEWER OF THIS MOVIE OR SEIRES
            // CHECK IF THE PROUDCT ARE ADD OF NOT
            if($insert == 1) {
                $selectProduct = "SELECT name,id FROM products WHERE name = '{$name}' LIMIT 1";
                $proud = select_row($selectProduct);
                
                $sqlView = "INSERT INTO views (name, counter, active, product_id) VALUES ('{$proud['name']}', 1, {$active}, {$proud['id']} ) ";
                $addView = query($sqlView);
            }else{
                $_SESSION['error'] = 'The Table Of View Of Product Are Not Created You Have To Add It Manual';
            }
        $_SESSION['success'] = "Congratulation ". ucfirst($type) . "  Are Created Successfully";
        redirect('../../products_view.php');
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
