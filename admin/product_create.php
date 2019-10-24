<?php
ob_start();
$pageTitle = 'Add Product';
include 'init.php';
checkGuest();
$sql = "SELECT id,name FROM sub_categories";
$subs = select_rows($sql);
?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
            </div>
            <div class="col-md-6 offset-md-3">
                <?php
                    view_alerts();
                ?>
                <div class='form-container  product-container  mt-5'>
                    <form action="process\products_process.php\add" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Product Name" class="form-control" >
                        </div>   
                        <div class="form-group">
                            <input type="hidden"  name="id">
                        </div>
                        <div class="form-group row">
                            <input type="text" name="year" placeholder="Year" class="form-control col-md-4 ml-3">
                            <input type="text" name="rate" placeholder="Rate" class="form-control col-md-4 ml-1">
                        </div>
                        
                        <div class='form-group'>
                            <select class='form-control' name='cate_id'>
                                <option selected disabled>Select Category</option>
                                <?php
                                    foreach($subs as $sub){
                                        echo "<option value='{$sub['id']}'"  . ">";
                                            echo $sub['name'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type </label>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="movie" name="type" class="custom-control-input" value="movie">
                                <label class="custom-control-label" for="movie">Movie</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="series" name="type" class="custom-control-input" value="series">
                                <label class="custom-control-label" for="series">Series</label>
                            </div>
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
                        <span class='notes text text-warning'>*  <b>[ Poster ]</b> The Maximum Size Is <b>[ 4MB ]</b></span>
                        <span class='notes text text-warning'>* The Allowed Extension Is <b>[ PNG, JPG, JPEG, GIF ]</b></span>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" id="customFile" name='poster'>
                            <label class="custom-file-label" for="customFile">Poster</label>
                        </div>
                        <span class='notes text text-warning'>Tags <b>[Separator By Comma (,)]</b></span>
                        <span class='notes text text-warning'><b>Ex :- </b>[Action, Love, Romaic]</b></span>
                        <div class="form-group">
                            <input type="text" name="tags" placeholder="Put  Tags" class="form-control" >
                        </div>
                        <textarea id ="y" class="form-control content" name="desc"></textarea>   
                    <input type="submit" name="" value="Update" class="btn btn-success mt-4 mb-4">
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