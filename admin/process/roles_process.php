<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

// CHECK CONDITION 
if($_SERVER['REQUEST_METHOD'] === 'POST'):
    
    // TO DEFIND THE STATUS LIKE [ADD, DELETE, ACTIVE, EDIT];
    $status = isset($_POST['status']) && !empty($_POST['status']) && is_string($_POST['status'])? $_POST['status'] : 'none';
    // TO DEFIND THE ID
    $id = isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])? intval($_POST['id']): 0;
    $response = [];
switch($status):

case 'active':
ajaxActiveRow('roles',$id);
break;

/************************** [ DELETE CASE ] ***************************/
case 'delete':
ajaxDeleteRow('roles',$id);
break;
/************************** [ ADD CASE ] ***************************/
case 'add':
    $errors = validator($_POST,[
        'name'      => 'required|min:4|max:50|string|unique:roles,name',
        'active'    => "numeric|in:0,1"
    ]);

    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $active = isset($_POST['active']) && is_numeric($_POST['active']) ? intval($_POST['active']): 0 ;if(empty($errors)):
    $sql = "INSERT INTO roles (name,active) VALUES ('{$name}', '{$active}')";
    $newRole = query($sql);
    if($newRole == 1) {
        echo "<div class='alert alert-success'> Congratulation ". ucfirst($name) . "  Are Created Successfully </div>";
    }else {
        echo "<div class='alert alert-warning'> There's Something Wrong in Data</div>";
        
    }
else:
    foreach($errors as $error):
        echo "<div class='alert alert-danger'>" . ucwords($error) .  "</div>";
        endforeach;
//redirect("back");
endif;
break;
/************************** [ ACTIVE CASE ] ***************************/
case 'show':

$searchQuery = '';
if(isset($_POST['search']) && !empty($_POST['search']) && is_string($_POST['search'])) {
$searchQuery = "WHERE name LIKE '%{$_POST['search']}%' OR created_at LIKE '%{$_POST['search']}%' OR updated_at LIKE '%{$_POST['search']}%'";   
}
$sql = "SELECT * FROM roles $searchQuery";
$roles = pagination('roles',$sql )['date'];

$buttons = pagination('roles', $sql)['button'];

?>
<table class='table table-hover table-dark  table-striped text-center'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Active</th>
            <th>Created_At</th>
            <th>Updated_At</th>
            <th>Action

            </th>
        </tr>
    </thead>
    <tbody class='response-data'>   
    <?php
    foreach($roles as $index => $role) {?>
        <tr>
        <td><?php echo $index + 1 ;?></td>
        <td><?php echo $role['name'] ;?></td>
        <td>
            <a href='process\roles_process.php' data-id='<?php echo $role['id']?>' class='activeRole'>
                <span class='fa fa-check-circle <?php echo $role['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                </span>
            </a>
        </td>
        <td><?php echo $role['created_at'] ;?></td>
        <td><?php echo $role['updated_at'] ;?></td>
        <td>
            <a href='role_edit.php?id=<?php echo $role['id']?>' class='far fa-edit text-primary mr-2'></a>
            <a href='process\roles_process.php' class='fa fa-times-circle text-danger confirmed deleteRole' data-id='<?php echo $role['id']?>'></a>
        </td>

        </tr>
<?php }?>
    </tbody>
</table>
<div class="pages">
    <?php echo $buttons ;?>
</div>
<?php 
break;
?>


<?php
/************************** [ DEFAULT CASE ] ***************************/
default:
   		$response +=  ['message' => "<div class='alert alert-danger message'>Bad Request </div>"];
        echo json_encode($response);
endswitch;
    



else:
    redirect("back");
endif;


