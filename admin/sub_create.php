<?php
ob_start();
$pageTitle = 'Add Sub-Category';
include 'init.php';
checkGuest();
$sql = "SELECT id,name FROM categories";
$cats = select_rows($sql);
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
                    <form action="process/subs_process.php/add" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Sub-Catagory Name" class="form-control" >
                        </div>   
                        <div class="form-group">
                            <input type="hidden"  name="id">
                        </div> 
                        <div class='form-group'>
                            <select class='form-control' name='cate_id'>
                                <option selected disabled>Select Category</option>
                                <?php
                                    foreach($cats as $cat){
                                        echo "<option value='{$cat['id']}'"  . ">";
                                            echo $cat['name'];
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