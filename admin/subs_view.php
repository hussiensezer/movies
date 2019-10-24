<?php
ob_start();
$pageTitle = 'Sub-Categories';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE sub_categories.active = 0' : ''; 
// FETCH ALL THE DATA SEND TO sub-Cateogries
$sql = "SELECT sub_categories.*, users.name AS created_by, categories.name AS in_category FROM sub_categories INNER JOIN users ON sub_categories.user_id = users.id  INNER JOIN categories ON sub_categories.category_id = categories.id ";
$subs = select_rows($sql);


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
                <a href='sub_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New Cateogry</a>
                <div class='table-responsive'>
                    <table class='table table-hover table-dark  table-striped text-center'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th> 
                                <th>Created_By</th>
                                <th>In_Category</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($subs as $index => $sub) {?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><?php echo $sub['name'] ;?></td>
                                <td>
                                    <a href='process\subs_process.php\active\<?php echo $sub['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $sub['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo ucfirst($sub['created_by']) ;?></td>
                                <td><?php echo ucfirst($sub['in_category']) ;?></td>

                                <td><?php echo $sub['created_at'] ;?></td>
                                <td><?php echo $sub['updated_at'] ;?></td>
                                <td>
                                    <a href='sub_edit.php?id=<?php echo $sub['id']?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\subs_process.php\delete\<?php echo $sub['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
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