<?php
ob_start();
$pageTitle = 'Users';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE users.active = 0' : ''; 
// FETCH ALL THE DATA SEND TO ROLES_VIEW


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

$sql = "SELECT users.* , roles.name AS role_name FROM users INNER JOIN roles ON roles.id = users.role_id {$searchQuery} {$active}  ";

$users = pagination('users',$sql )['date'];

$buttons = pagination('users', $sql)['button'];


?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <div class="container mb-5 mt-5">
                    <form class="row">
                    <div class="col-col-md-4">
                    <a href='user_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New User</a>
                    </div>
                        <div class="form-group col-md-4 offset-md-5">
                            <input type="search" name="q" class="form-control" placeholder="Search" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Search" class="btn btn-success">
                        </div>
                    </form>
                </div>
                <?php
                    view_alerts();
                ?>
                <div class='table-responsive'>
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
                            foreach($users as $index => $user) {?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><?php echo $user['name'] ;?></td>
                                <td><?php echo $user['email'] ;?></td>
                                <td><img class='avatar' src="uploads/avatars/<?php echo $user['avatar'] ;?>" alt="avatar"></td>
                                <td><?php echo $user['role_name'] ;?></td>
                                <td>
                                    <a href='process\users_process.php\active\<?php echo $user['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $user['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $user['created_at'] ;?></td>
                                <td><?php echo $user['updated_at'] ;?></td>
                                <td>
                                    <a href='user_edit.php?id=<?php echo $user['id']?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\users_process.php\delete\<?php echo $user['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
                                </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    echo !empty($buttons) ? $buttons : '';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END RIGHT SIDE -->





<!-- THE FOOTER -->
<?php 
include $tpl . 'footer.php';
ob_end_flush();
?>