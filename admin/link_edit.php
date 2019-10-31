<?php
ob_start();
$pageTitle = 'Edit Link';
include 'init.php';
checkGuest();
// FETCH THE ROLE WHO WE ARE SELECT BY THE GET FOR ID TO EDIT OF HIS DATA
$link = fetchForEdit('url_product',$_GET['id']);
$sql = "SELECT id,name FROM episode_product  WHERE  product_id = {$_GET['idprod']} ORDER BY id DESC";
$prods = select_rows($sql);
?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo str_replace('-', ' ', $_GET['on'])  . ' ' .'<small>'. $_GET['epi'] . '</small>'?></h1>
                <?php
                    view_alerts();
                ?>
                <div class='form-container col-md-4 offset-md-4 mt-5'>
                    <form action="process/links_process.php/update" method="POST">
                        <div class="form-group">
                            <input type="text" name="link" placeholder="Link Name" class="form-control" value="<?php echo $link['link']?>">
                        </div>   
                        <div class="form-group">
                            <input type="hidden"  name="id" value="<?php echo $link['id']?>">
                        </div>
                        <div class='form-group'>
                            <select class='form-control' name='episode_id'>
                                <option selected disabled>Select Episode</option>
                                <?php
                                    foreach($prods as $prod){
                                        echo "<option value='{$prod['id']}'". ($prod['id'] == $link['episode_id'] ? 'selected' : '') . ">";
                                            echo $prod['name'];
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
                                        if($link['active'] == 1) { echo "checked";}
                                    ?>
                                    >
                                <label class="custom-control-label" for="active">active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-block ml-3">
                                <input type="radio" id="deactive" name="active" class="custom-control-input" value="0"
                                    <?php
                                        if($link['active'] == 0) { echo "checked";}
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