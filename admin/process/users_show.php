<?php
ob_start();
$back = '';
$noNavbar = '';
$noHeader = '';
include '../init.php';

checkGuest();

if(isset($_GET['status']) && $_GET['status'] == 'show'):




// SEARCH AND LIMIT OF SHOW
$searchQuery = '';
$limit = 10;
$numbers = [10,20,50,100];
if(isset($_GET['q']) && !empty($_GET['q']) && is_string($_GET['q'])) {
$searchQuery = "WHERE users.name LIKE '%{$_GET['q']}%' OR email LIKE '%{$_GET['q']}%' OR users.active  LIKE '%{$_GET['q']}%' OR users.created_at LIKE '%{$_GET['q']}%' OR users.updated_at LIKE '%{$_GET['q']}%'";   
}

if(isset($_GET['limit']) && !empty($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$sql = "SELECT users.* , roles.name AS role_name FROM users INNER JOIN roles ON roles.id = users.role_id {$searchQuery}   ";

$users = pagination('users',$sql )['date'];

$buttons = pagination('users', $sql)['button'];

?>

 <table class='table table-hover table-dark  table-striped text-center'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Control</th>
            <th>Active</th>
            <th>Created_At</th>
            <th>Updated_At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($users as $index => $user):
        ?>
            <tr>
            <td><?php echo $index + 1 ;?></td>
            <td><?php echo $user['name'] ;?></td>
            <td><?php echo $user['email'] ;?></td>
            <td><img class='avatar' src="uploads/avatars/<?php echo $user['avatar'] ;?>" alt="avatar"></td>
            <td><?php echo $user['role_name'] ;?></td>
            <td>
                <a href='process\users_active.php?id=<?php echo $user['id']?>' data-id='<?php echo $user['id']?>' id="active-user">
                    <span class='fa fa-check-circle <?php echo $user['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                    </span>
                </a>
            </td>
            <td><?php echo $user['created_at'] ;?></td>
            <td><?php echo $user['updated_at'] ;?></td>
            <td>
                <a href='user_edit.php?id=<?php echo $user['id']?>' class='far fa-edit text-primary mr-2'></a>
                <a href='process\users_delete.php?id=<?php echo $user['id']?>' data-id="<?php echo $user['id']?>" id='delete-user' class='fa fa-times-circle text-danger'></a>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
echo !empty($buttons) ? $buttons : '';

else:
    echo "<div class='alert alert-danger'>You Can't Vist The Page Dirctly </div>";
endif;

ob_end_flush();
