<?php
ob_start();
$pageTitle = 'Users';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE users.active = 0' : ''; 
// FETCH ALL THE DATA SEND TO ROLES_VIEW
$sql = "SELECT users.* , roles.name AS role_name FROM users INNER JOIN roles ON roles.id = users.role_id {$active}";
$users = select_rows($sql);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <?php
                    view_alerts();
                ?>
                <a href='user_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New User</a>
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