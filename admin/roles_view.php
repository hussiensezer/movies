<?php
ob_start();
$pageTitle = 'Roles';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE active = 0' : ''; 
// FETCH ALL THE DATA SEND TO ROLES_VIEW
$sql = "SELECT * FROM roles {$active}";
$roles = select_rows($sql);
echo password_hash(123456, PASSWORD_DEFAULT);
?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'>Roles</h1>
                <?php
                    view_alerts();
                ?>
                <a href='role_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New Role</a>
                <div class='table-responsive'>
                    <table class='table table-hover table-dark  table-striped text-center'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($roles as $index => $role) {?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><?php echo $role['name'] ;?></td>
                                <td>
                                    <a href='process\roles_process.php\active\<?php echo $role['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $role['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $role['created_at'] ;?></td>
                                <td><?php echo $role['updated_at'] ;?></td>
                                <td>
                                    <a href='role_edit.php?id=<?php echo $role['id']?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\roles_process.php\delete\<?php echo $role['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
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