<?php
ob_start();
$pageTitle = 'Add Role';
include 'init.php';
checkGuest();


?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'>Add Role</h1>
                <?php
                    view_alerts();
                ?>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/roles_process.php/add" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Role Name" class="form-control">
                        </div>   
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="active">active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                    </div>
                    <input type="submit" name="" value="Create" class="btn btn-success">
                    </form>
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