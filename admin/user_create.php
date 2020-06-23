<?php
ob_start();
$pageTitle = 'Add User';
$ajax = 'user_ajax.js';
include 'init.php';
checkGuest();


// SELECT THE ROLES ROWS TO BE MATCHING WITH USER
$sql = "SELECT id,name FROM roles";
$roles = select_rows($sql);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                   <div class="respone"></div>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/users_create.php" method="POST" enctype='multipart/form-data' id="create-user">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email Address" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" placeholder="Your Password" class="form-control">
                        </div>
                        <div class='form-group'>
                           <label>* Role Name</label>
                            <select class='form-control' name='role'>
                                
                                <?php
                                    foreach($roles as $role){
                                        echo "<option value='{$role['id']}'" . ">";
                                            echo $role['name'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                        </div>
                        <span class='notes text text-warning'>*  <b>[ Avatar ]</b> The Maximum Size Is <b>[ 2MB ]</b></span>
                        <span class='notes text text-warning'>* The Allowed Extension Is <b>[ PNG, JPG, JPEG, GIF ]</b></span>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name='avatar'>
                            <label class="custom-file-label" for="customFile">Avatar</label>
                        </div>
                        <input type="submit" name="" value="Update" class="btn btn-success mt-3">

                        
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