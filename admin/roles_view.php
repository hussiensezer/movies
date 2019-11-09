<?php
ob_start();
$pageTitle = 'Roles';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE active = 0' : ''; 

// SEARCH AND LIMIT OF SHOW
$searchQuery = '';
$limit = 10;
$numbers = [10,20,50,100];
if(isset($_GET['q']) && !empty($_GET['q']) && is_string($_GET['q'])) {
$searchQuery = "WHERE name LIKE '%{$_GET['q']}%' OR created_at LIKE '%{$_GET['q']}%' OR updated_at LIKE '%{$_GET['q']}%'";   
}

if(isset($_GET['limit']) && !empty($_GET['limit']) && is_numeric($_GET['limit'])) {
$limit = $_GET['limit'];
}

$sql = "SELECT * FROM roles $searchQuery $active";
$roles = pagination('roles',$sql )['date'];

$buttons = pagination('roles', $sql)['button'];



// FETCH ALL THE DATA SEND TO ROLES_VIEW
// $sql = "SELECT * FROM roles {$active} {$searchQuery} LIMIT 1";
// $roles = select_rows($sql);

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
                    <a href='role_create.php' class='btn btn-success  mb-4'> <i class="fas fa-plus mr-1"></i>New Role</a>
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