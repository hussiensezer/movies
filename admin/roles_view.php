<?php
$pageTitle = 'Roles';
include 'init.php';
autoInclude(__FILE__,'model');
//print_r($roles);
echo $sql;
?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'>Roles</h1>
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
                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>0</td>
                                <td>2019</td>
                                <td>2019</td>
                                <td>2019</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>0</td>
                                <td>2019</td>
                                <td>2019</td>
                                <td>2019</td>
                            </tr>
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
?>