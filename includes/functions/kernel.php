<?php

session_start();
require "connection.php";
require 'validator.php';
/*************************** [LIST OF HELPER FUNCTION] ***************************/
// urlParse()
// AutoInclude()
// getTitle()
// checkGuest()
// total() || totalRows() SAME STATES
// view_alerts()
// redirect()
// query()
// select_row()
// select_rows()
// updateActive()
// deleteRow()
// fetchForEdit()
// uploadAvatar()
// checkAvatar()
// viewsCountUpdate()
// countWithoutFormat()
/*************************** [LIST OF HELPER FUNCTION] ***************************/








/*
** urlParse => V.1
** to Make URL PARAMETERS ARE SMALL PIECES To CAN FOUND THE CASE AND IF
** $url[2] = THE CASE LIKE [ Add, Delete , Active, Updated ] CASE
** $url[3]  THE [ID] WILL WHO THE CASE WILL WORK ON IT
*/
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
** getTitle => V.1
** Function To get The Title Of Page
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
** checkGuest V.1
**Function To Check if the Login Are Admin or Not To Take Action
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
** total => V.1
** Function To Count The Total Of Rows in Table You Are Selected
*/

function total($table, $where = NULL) {    
$sql = "SELECT COUNT(id) AS count FROM {$table}  {$where}";
$total = select_row($sql);
return $total['count'];
}

/*
** view_alerts => V.1
** To View All Alerts Like [ Errors, Success, Wrong, Error]
*/
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
	if(isset($_SESSION['warning'])){
	echo '<div class="alert alert-warning alert-dismissible fade show">' . $_SESSION['warning'] ;
		echo  ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			echo '<span aria-hidden="true">&times;</span>';
		echo' </button>';
	echo'</div>';
		unset($_SESSION['warning']);		
	}
}


/*
** redirect => V.2
** Function To Redirect Where ever You Need
*/
function redirect($path = NULL) {
	if($path == NULL) {
    $path = 'index.php';
    }elseif($path == 'back') {
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            $path = $_SERVER['HTTP_REFERER'];
        }else {
            $path = 'index.php';
        }
    }else {
        $path = $path;
	}
	header("Location: {$path}");
    exit();
}

/*
** query => v.1
** query function to connect with DATABASE 
*/
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

/*
** select_rows => v.1
** FETCH ALL ROW OF TABLE YOU SELECT
*/
function select_rows($sql) {
$query = query($sql);
$data = mysqli_fetch_all($query, true);
return $data;
}

/*
** select_row => v.1
** JUST FETCH ONE ROW
*/
function select_row($sql) {
$query = query($sql);
$row = mysqli_fetch_assoc($query);
return $row;
}








/*
** UpdateActive => v.2
** Function The Update The Active Status To [Active Or Deactive] ;
** Its Just Take 2 Parameter
*** Table like ['users', categories]
** Id 
*/


function updateActive($table,$id,$path = 'back') {
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
		redirect($path);
	}else {
		$_SESSION['error'] = "There's No Such <b>Id</b> Or You Trying To Do Something Bad";
		redirect($path);
	} 
}
/*
** DeleteRow => V.2
** FUNCTION TO DELETE ANY ROW IN ANY TABLE YOU NEED ;
** JUST GIVE IT 2 PARAMATERS LAST ONE ARE OPITION
*/
function deleteRow($table,$id,$path ='back'){
	$sql = "SELECT * FROM $table WHERE id = $id LIMIT 1";
	$data = select_row($sql);
	if(!empty($data)){
		$sql = "DELETE FROM {$table} WHERE id = {$id}";
		$delete = query($sql); 
		if($delete == TRUE) {
			$_SESSION['success'] = "Congratualtion This Row Are <b>Deleted Successfully</b>";
			redirect($path);
		}else {
			$_SESSION['errors'] = "There's Some Error's Like Can't Delete because it's Foreign Key , Wrong Id";
		}
	}else{
		$_SESSION['error'] = "There's No Such <b>Id</b> Or You Trying To Do Something Bad";
		redirect($path);
	}
	
}

/*
** FetchForEdit => V.1
** FUNCTION TO FETCH THE DATA FOR THE ROW WHO SELECT TO PERESENT THE DATA TO EDIT IT
**	JUST GIVE IT 2 PARAMATERS  REQUEST $table, $id
**  $PATH ARE OPTIONAL
*/
function fetchForEdit($table,$id,$path = 'back') {
    $id = isset($id) && is_numeric($id) ? intval($id) : 0;
    $sql = "SELECT * FROM $table WHERE id = {$id} ";
    $row = select_row($sql);
    if(empty($row)) {
        $_SESSION['error'] = "There's No Such <b>Id</b> Or You Trying To Do Something Bad";
        redirect($path);
	}
	return $row;
}

/*
** uploadAvatar => V.1
** FUNCTION FOR UPLOAD IMAGES TO THE UPLOADS FILE
*/
function uploadAvatar(Array $avatar, $size, $path) {
	global	$errors;
/**** START FILES LOGIC ****/
//UPLOAD FILES VARIABLE
$avatarName = $avatar['name'];
$avatarSize = $avatar['size'];
$avatarTmp  = $avatar['tmp_name'];
$avatarType = $avatar['type'];
//LIST OF ALLOWED FILE TYPE TO UPLOAD AND THE MIXIMUM SIZE 3MB
$allowedExtension = ['jpeg', 'png', 'jpg','gif'];
$maximumSize = ($size * 1024 * 1024); // 3MB
$tmp = explode('.', $avatarName);
$avatarExtension = end($tmp);
/**** START FILES LOGIC ****/

// MAKE VALID FOR AVATAR
if(!in_array($avatarExtension, $allowedExtension)){
	$errors[]= 'This Extension Are Not <b>Allowed</b> The Allowed Extension Is <b>[ PNG, JPG, JPEG, GIF ]</b>';
}
if($avatarSize > $maximumSize) {
	$errors[] = "{$path} Size Can't Be More Then {$size}MB";
}

if(empty($errors)){
	$name = "{$path}-" . rand(0,10000000000) . '.' . $avatarExtension;
	move_uploaded_file($avatarTmp, "../uploads\\{$path}\\" . $name);
	return $name;
}else {
	$_SESSION['errors'] = $errors;
	redirect('back');
}
}


/*
**checkAvatar => V.1
** $fileName = THE NAME OF FILES  => [$_FILE['avatar']['name']]
** $checkOn = THE AVATAR NAME IN DATABASE => [ $user['avatar'], $course['avatar'] ]
** $fileData = THE ARRAY OF $_FILES,
** $size = THE MAXIMUM OF SIZE BY [ MB ] YOU NEED TO UPLOAD;
** $path = THE FILE WILL SAVE AVATAR THERE LIKKE => ['avatars, poster', 'cast', 'shots'] file
**
*/

function checkAvatar($fileName,$checkOn,$fileData,$size, $path) {
		
		$avatarPath = "..\uploads\\{$path}\\" . $checkOn;
		if(!empty($fileName)){
			if(file_exists($avatarPath)){
				$avatar = uploadAvatar($fileData, $size, $path);
				unlink($avatarPath);
			}else{
				$_SESSION['warning'] = "Theres No Avatar For This Row But We Upload A New Avatar For Him";
				$avatar = uploadAvatar($fileData, $size, $path);
			}
		}else {
		$avatar = $checkOn;    
		}
		return $avatar;
	
	}

/*
** viewsCountUpdate => v.1
** $table = THE TABLE WHO WILL SELECT [users,employ];
** $id = THE identity ;
** $WHERE = THE COLUM WHO SELECTED TO FETCH THE DATA
** $colum = THE COLUM THE DATA WILL BE UPDATED ON HIM
*/

function viewsCountUpdate($table,$id,$where ,$colum) {
$sql = "SELECT * FROM {$table} where $where =  {$id}";
$view = select_row($sql);
$counter = $view[$colum]+1;
$sqltwo = "UPDATE {$table} SET $colum = {$counter} WHERE $where = {$id} ";
$update = query($sqltwo);
return $counter;
}


/*
** totalRows => v.1
**
*/
function totalRows($table, $count = '*') {
	$sql = "SELECT COUNT($count) FROM $table";
	$query = select_row($sql);
	$total = $query['COUNT(*)'];
	return $total;
}

/*
** countRows => v.1
*/
function countRows($col, $table) {
	$sql = "SELECT SUM($col) FROM $table";
	$query =  select_row($sql);
	$count = $query["SUM($col)"];
	$format = formatNumber($count);
	echo $format;
}
/*
** countWithoutFormat => v.1
*/
function countWithoutFormat($col, $table) {
	$sql = "SELECT SUM($col) FROM $table";
	$query =  select_row($sql);
	$count = $query["SUM($col)"];
	return $count;
}
/*
*** formatNumber => v.1 
*/
function formatNumber($num){
	$n = (0+str_replace(",","",$num));
    // is this a number?
    if(!is_numeric($n)) return false;
    // now filter it;
    if($n>1000000000000) return round(($n/1000000000000),1).' t';
    else if($n>1000000000) return round(($n/1000000000),4).' b';
    else if($n>1000000) return round(($n/1000000),2).' m';
    else if($n>1000) return round(($n/1000),3).' k';
	return number_format($n);
}



/*
** 
*/
function lastestRows($select = '*', $from, $order, $limit) {
	$sql = "SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit";
	$data = select_rows($sql);
	return $data;
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


function pagination($table, $sql, $amount = 10) {
	global $searchQuery; 
	$page = 1 ;
	$total = totalRows($table);
	$pageCount = ceil($total / $amount);




if(isset($_GET['page']) && !empty($_GET['page']) ) {
	if(is_numeric($_GET['page']) && $_GET['page'] <= $pageCount ){
		$page = $_GET['page'];
	} 
}
$offset = ($page - 1) * $amount ;
$sql = " $sql LIMIT {$amount} OFFSET  {$offset}";
$result = select_rows($sql);

$button = '<nav aria-label="Page navigation">';
$button  .= '<ul class="pagination">';
for($i = 1 ; $i <= $pageCount ; $i++) {
	if (in_array($i, [1,$page - 1, $page - 2 ,$page, $page + 1,  $page + 2, $pageCount - 1, $pageCount])) {
		if($page == $i) {
		$button .= "<li class='active page-item bg-dark text-white'> <a href='?page{$i}' class='page-link'> {$i} </a> </li>";
		} else {
			$button .=  "<li class='page-item '><a href='?page={$i}' class='page-link '>{$i}</a></li>";
		}
	}
}
$button .= "</ul>";
$button .= "</nav>";
return[
	'date' => $result,
	'button' => $button
];

}
