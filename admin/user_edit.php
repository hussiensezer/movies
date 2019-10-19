<?php
ob_start();
$pageTitle = 'Edit User';
include 'init.php';
checkGuest();

// FETCH THE ROLE WHO WE ARE SELECT BY THE GET FOR ID TO EDIT OF HIS DATA
$user = fetchForEdit('users',$_GET['id']);

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
                <?php
                    view_alerts();
                ?>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/users_process.php/update" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" class="form-control" value="<?php echo $user['name']?>">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email Address" class="form-control" value="<?php echo $user['email']?>">
                        </div>
                        <div class="form-group">
                            <span class='notes text text-warning'>* If Won't Change <b>[ Password ]</b> Leave It Empty</span>
                            <input type="password" name="pass" placeholder="Your Password" class="form-control">
                        </div>
                        <div class='form-group'>
                            <select class='form-control' name='role'>
                                <option selected disabled>Select Role</option>
                                <?php
                                    foreach($roles as $role){
                                        echo "<option value='{$role['id']}'" . ($role['id'] == $user['role_id'] ? 'selected' : '') . ">";
                                            echo $role['name'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1"
                                    <?php
                                        if($user['active'] == 1) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0"
                                    <?php
                                        if($user['active'] == 0) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                        </div>
                        <span class='notes text text-warning'>* If Won't Change <b>[ Avatar ]</b> Leave It Empty</span>
                        <span class='notes text text-warning'>* If You Will Update <b>[ Avatar ]</b> The Maximum Size Is <b>[ 2MB ]</b></span>
                        <span class='notes text text-warning'>* The Allowed Extension Is <b>[ PNG, JPG, JPEG, GIF ]</b></span>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name='avatar'>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <input type="submit" name="" value="Update" class="btn btn-success mt-3">
                        <div class="form-group">
                            <input type="hidden"  name="id" value="<?php echo $user['id']?>">
                        </div> 
                        
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