<?php
ob_start();
$pageTitle = 'Edit Category';
$ajax = 'cate_ajax.js';
include 'init.php';
checkGuest();
// FETCH THE CATEGORIES WHO WE ARE SELECT BY THE GET FOR ID TO EDIT OF HIS DATA
$cate = fetchForEdit('categories',$_GET['id']);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <div class="respone-message"></div>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/categories_update.php" method="POST" id="update-form">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Role Name" class="form-control" value="<?php echo $cate['name']?>">
                        </div>   
                        <div class="form-group">
                            <input type="hidden"  name="id" value="<?php echo $cate['id']?>">
                        </div> 
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1"
                                    <?php
                                        if($cate['active'] == 1) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0"
                                    <?php
                                        if($cate['active'] == 0) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success updated">Updated</button>
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