<?php
ob_start();
$pageTitle = 'Edit Roles';
include 'init.php';
checkGuest();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM roles WHERE id = {$id}";
$role = select_row($sql);

if(empty($role)) {
    $_SESSION['error'] = "There's No Such <b>Id</b> Or You Trying To Do Something Bad";
    redirect('roles_show.php');
}

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'>Edit Roles</h1>
                <?php
                    view_alerts();
                ?>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/roles_process.php/update" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Role Name" class="form-control" value="<?php echo $role['name']?>">
                        </div>   
                        <div class="form-group">
                            <input type="hidden"  name="id" value="<?php echo $role['id']?>">
                        </div> 
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1"
                                    <?php
                                        if($role['active'] == 1) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="active">active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0"
                                    <?php
                                        if($role['active'] == 0) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                    </div>
                    <input type="submit" name="" value="Update" class="btn btn-success">
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