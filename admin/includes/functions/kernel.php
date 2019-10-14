<?php

session_start();
require "connection.php";
require 'validator.php';



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
			require_once $controller;
			require_once $model;
		}else {
			$_SESSION['error'] = $controller . '<br>' . $model . '<br>' .'Files Are Not Exists'; 
		}
	}else {
		$where =    $dir . $DS . $who . $DS . $path . '_' . $who .'.php';
		if(file_exists($where)) {
			require_once $where;;
		}else {
			$_SESSION['error'] = "<b>". $who . "</b>" . ' File Are Not Exists'; 
		}
	}
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
            redirect('../login.php');  

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
	header("refresh:0; url=$path");
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
** Function The Update The Active Status To [Active Or Deactive] v.1;

*/

function updateActive($table,$date,$id,$path = 'back') {
    $sql = "UPDATE {$table} SET active = {$date} WHERE id = {$id}";
    $update = query($sql);
    if($date == 1) {
        $status = 'Active';
    }else {
        $status = 'Deactive';
    }
	$_SESSION['success'] = "Congratulation This Row Are <b> {$status}</b>";
	 redirect('back');

}


function deleteRow($table,$id,$path){
    
    $sql = "DELETE FROM {$table} WHERE id = {$id}";
    $delete = query($sql);
    $_SESSION['success'] = "Congratualtion This Row Are Deleted";
    redirect($path);
}



// validator
// redirect
// select_rows
// select_row
// $auth
// middleware_auth
// middleware_admin
// middleware_student



