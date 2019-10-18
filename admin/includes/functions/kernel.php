<?php

session_start();
require "connection.php";
require 'validator.php';
/*************************** [LIST OF HELPER FUNCTION] ***************************/
// urlParse
// AutoInclude
//getTitle
//checkGuest
//total
//view_alerts
//redirect
//query
//select_row
//select_rows
//updateActive
//deleteRow
/*************************** [LIST OF HELPER FUNCTION] ***************************/

function urlParse() {
	return $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH), '/'), 4);
}

/*
** v.1 => FUNCTION AUTO INCLUDE THE FILE BY FILE NAME 
** THIS FUNCTION TO WORK YOU MUST RENAME ALL MVC FILES BY SAME NAME
** IF VIEW(roles_view.php) MUST THE CONTROLLER(roles_controller.php) SAME STATE THEe
*/
function autoInclude($here, $who = 'all'){

    $file =  basename($here, '.php');
    $explode = explode('_', $file);
    $path = $explode[0];
    $dir = dirname($here);
    $DS = DIRECTORY_SEPARATOR;
    
	if($who == 'all') {
		$controller =    $dir . $DS . 'controller' . $DS . $path . '_controller.php';
		$model =  $dir . $DS . 'model' . $DS . $path . '_model.php';
		
		if(file_exists($controller) && file_exists($model)) {
			require_once "{$controller}";
			require_once "{$model}";
		}else {
			$_SESSION['error'] = $controller . '<br>' . $model . '<br>' .'Files Are Not Exists'; 
		}
	}else {
		$where = $who . $DS . $path . '_' . $who .'.php';
		if(file_exists($where)) {
			$result =	require_once "{$where}";
		}else {
			$_SESSION['error'] = "<b>". $who . "</b>" . ' File Are Not Exists'; 
		}
	}
	return $result;
}


/*
** Function To get The Title Of Page V 1.0
*/

function getTitle() {
    global $pageTitle;
    if(isset($pageTitle)) {
        echo $pageTitle;
    }else {
        echo "Default";
    }
}

/*
**Function To Check adminborad isset
*/
function checkGuest() {
    global $back;
    if(isset($_SESSION['admin'])){
		$sql = "SELECT * FROM users WHERE id = {$_SESSION['admin']} LIMIT 1";
		$data = select_row($sql);
		return $data;
        
    }else {
        if(isset($back)){
            redirect('../../login.php');  

        }else {
            redirect('login.php');  
        }
    }
}


/*
** Function To Count The Total 
*/

function total($table, $where = NULL) {
    
    $sql = "SELECT COUNT(id) AS count FROM {$table}  {$where}";
    $total = select_row($sql);
    return $total['count'];
}


function view_alerts() {
	if (isset($_SESSION['success'])) {
		echo '<div class="alert alert-success alert-dismissible fade show">' . $_SESSION['success'] ;
			echo  ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
			echo' </button>';
		echo'</div>';

		unset($_SESSION['success']);
	}
	if (isset($_SESSION['error'])) {
		echo '<div class="alert alert-danger alert-dismissible fade show">' . $_SESSION['error'] ;
			echo  ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			echo '<span aria-hidden="true">&times;</span>';
		echo' </button>';
	echo'</div>';
		unset($_SESSION['error']);
	}
	if (isset($_SESSION['errors'])) {
		
		foreach ($_SESSION['errors'] as $error) {
            echo '<div class="alert alert-danger alert-dismissible fade show">';
				echo $error;
				echo  ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					echo '<span aria-hidden="true">&times;</span>';
				echo' </button>';
            echo '</div>';
		}


		unset($_SESSION['errors']);
	}
}


/*
** Function To Redirect Where everYou Need V.2
*/
function redirect($path = NULL) {
    
	if($path == NULL) {
    $path = 'adminboard.php';
        
    }elseif($path == 'back') {
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            $path = $_SERVER['HTTP_REFERER'];
        }else {
            $path = 'adminboard.php';
        }
        
    }else {
        $path = $path;
	}
	
	header("Location: {$path}");

    exit();
}


function query($sql) {
	global $connection;

	$query = mysqli_query($connection, $sql);

	$error = mysqli_error($connection);

	if (!empty($error)) {
		echo $error;
		die();
	}

	return $query;
}

function select_rows($sql) {
	$query = query($sql);

	$data = mysqli_fetch_all($query, true);

	return $data;
}

function select_row($sql) {
	$query = query($sql);

	$row = mysqli_fetch_assoc($query);

	return $row;
}








/*
** Function The Update The Active Status To [Active Or Deactive] v.2;
** Its Just Take 2 Parameter
*** Table like ['users', categories]
** Id 
*/


function updateActive($table,$id) {
	$sql = "SELECT * FROM $table WHERE id = $id LIMIT 1";
	$data = select_row($sql);
	if(!empty($data)){
		if($data['active'] == 1 ){
			$sql = "UPDATE {$table} SET active = 0 WHERE id = {$id}";
			$update = query($sql);
			$status = 'DeActive';
		}else{
			$sql = "UPDATE {$table} SET active = 1 WHERE id = {$id}";
			$update = query($sql);
			$status = 'Active';
		}
		$_SESSION['success'] = "Congratulation This Row Are <b> {$status}</b> Successfully";
		redirect('back');
	}else {
		$_SESSION['error'] = "There's No Such <b>Id</b> Or You Trying To Do Something Bad";
		redirect("back");
	} 
}

function deleteRow($table,$id,$path ='back'){
    
    $sql = "DELETE FROM {$table} WHERE id = {$id}";
	$delete = query($sql);
	echo $delete; 
	if($delete) {
		$_SESSION['success'] = "Congratualtion This Row Are <b>Deleted Successfully</b>";
		redirect($path);
	}else {
		$_SESSION['errors'] = "There's Some Error's Like Can't Delete because it's Foreign Key , Wrong Id";
	}
}


// //view
// $data = autoInclude(__FILE__,'model');
// if(is_array($data)){
//     extract($data);
// }
// print_r($do);
// print_r($x);
// //Model

// $do = ['hussien', 'attia'];
// $x = select_rows($sql);
// $sql = 'SELECT * FROM roles';
// return[
//     'do' => $do,
//     'x' => $x,
// ];
