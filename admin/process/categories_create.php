<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if($_SERVER['REQUEST_METHOD'] == 'POST'):
$errors = validator($_POST,[
   'name' => 'required|string|min:3|max:50|unique:categories,name',
   'active'    => "required|numeric|in:0,1"
]);
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = isset($_POST['active']) && is_numeric($_POST['active']) ? intval($_POST['active']): 0 ;
    $user   = $_SESSION['admin'];
    // Check If This Name are Unique After Sanitize
    $sql = "SELECT * FROM categories WHERE name = '{$name}'";
    $check = query($sql);
    if(!empty($check)){
        $errors[] = $name . " Has already been taken..";
    }    
    if(empty($errors)):
        $sql = "INSERT INTO categories (name, active, user_id) VALUES ('{$name}', '{$active}', '{$user}')";
        $create = query($sql);
        if($create == 1): 
            echo "<div class='alert alert-success'> Congratulation ". ucfirst($name) . "  Are Created Successfully </div>";
        else:
            echo "<div class='alert alert-warning'> There's Something Wrong in Data</div>";
        endif; // End If Check Condition If $Create ==1

    else:
        foreach($errors as $error):
        echo "<div class='alert alert-danger'>" . ucwords($error) .  "</div>";
        endforeach;
    endif;// End If $Errors
else:

echo "<div class='alert alert-danger'> You Enter By Wrong Gate Try Other One ... </div>";
endif; // End If Request Method
