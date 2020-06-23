<?php
ob_start();
$ajax = "cate_ajax.js";
$pageTitle = 'Add Categories';
include 'init.php';
checkGuest();


?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <div class="respone-message"></div>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/categories_create.php" id="create-category" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Category Name" class="form-control">
                        </div>   
                        <div class="form-group">
                            <label>Status </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="active" name="active" class="custom-control-input" value="1" checked>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="deactive">Deactive</label>
                            </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Create</button>
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