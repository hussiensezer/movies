<?php
ob_start();
$pageTitle = 'Categories';
$ajax = 'cate_ajax.js';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? 'WHERE active = 0' : ''; 



?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                 <div class="response"></div>
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
                        <tbody id='show-data'>
                           

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