<?php
ob_start();
$pageTitle = 'Add Role';
$ajax = 'ajax.js';
include 'init.php';
checkGuest();


?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
               <div class="col-md-12 message-box">
                   
               </div>
                <div class='form-container col-md-5 offset-md-4 mt-5'>
                    <form action="process/roles_process.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Role Name" class="form-control" id="role_name">
                            <p class='alert alert-danger  mt-2 valid-role valid-message'> This Field Can't Be Empty Or Less Then 3 </p>
                        </div>   
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1" >
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                            <p class='alert alert-danger  mt-2 valid-active valid-message'> You Have To Selected One Or The 2 Choose </p>

                    </div>
                    <button type="submit" name="submit"  class="btn btn-success">Create</button>
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