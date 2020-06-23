<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if($_SERVER['REQUEST_METHOD'] == 'POST'):
 // OUR POST'S
    $id     = $_POST['id'];
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = isset($_POST['active']) && is_numeric($_POST['active']) ? intval($_POST['active']): 0 ;


    //THIS QUERY TO CHECK IF THERE IN DATABASE ARE SUB-CATE WITH THIS ID
    $getcate    =  "SELECT * FROM categories WHERE id = {$id} LIMIT 1";
    $cate       =  select_row($getcate);

    /* This If Condition For Check If The POST['name'] are not Equel the name of cate in database
    do something else check if this exists or not*/
    $condition = $cate['name'] != $name ? '|unique:categories,name' : '|exists:categories,name';

    // CHECK IF THE POSTS ARE VALID TO UPDATE IN DATABASE OR NOT
    $errors = validator($_POST,[
        'id'         => 'required|numeric|exists:categories,id',
        'name'       => "required|max:100|string{$condition}",
        'active'     => "numeric|in:0,1"
    ]);
    // CHECK IF THERE NO ERRORS IN VALIDATOR FUNCTION
    if(empty($errors)){
        $sql    = "UPDATE categories SET name = '{$name}' ,active = '{$active}' WHERE id = {$id} ";
        $update = query($sql);
        if($update == 1):
            echo "<div class='alert alert-success'> Congratulation ". ucfirst($name) . "  Are Updated Successfully </div>";
        else:
             echo "<div class='alert alert-warning'> There's Something Wrong in Data</div>";
        endif;
    }else{
        foreach($errors as $error):
        echo "<div class='alert alert-danger'>" . ucwords($error) .  "</div>";
        endforeach;
    }
else:

echo "<div class='alert alert-danger'> You Enter By Wrong Gate Try Other One ... </div>";
endif; // End If Request Method
