<?php
ob_start();
$pageTitle = 'Categories';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE active = 0' : ''; 
// FETCH ALL THE DATA SEND TO Cateogries
$sql = "SELECT categories.*, users.name AS created_by FROM categories INNER JOIN users ON categories.user_id = users.id {$active}";
$cateogries = select_rows($sql);


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
                <a href='category_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New Cateogry</a>
                <div class='table-responsive'>
                    <table class='table table-hover table-dark  table-striped text-center'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Created_By</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($cateogries as $index => $cat) {?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><?php echo $cat['name'] ;?></td>
                                <td>
                                    <a href='process\categories_process.php\active\<?php echo $cat['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $cat['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo ucfirst($cat['created_by']) ;?></td>
                                <td><?php echo $cat['created_at'] ;?></td>
                                <td><?php echo $cat['updated_at'] ;?></td>
                                <td>
                                    <a href='category_edit.php?id=<?php echo $cat['id']?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\categories_process.php\delete\<?php echo $cat['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
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