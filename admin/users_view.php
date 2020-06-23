<?php
ob_start();
$pageTitle = 'Users';
$ajax = 'user_ajax.js';
include 'init.php';
checkGuest();


?>

<noscript> <?php //redirect("https://www.google.com") ?></noscript>

<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <div class="container mb-5 mt-5">
                    <form class="row">
                    <div class="col-col-md-4">
                    <a href='user_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New User</a>
                    </div>
                        <div class="form-group col-md-4 offset-md-5">
                            <input type="search" name="q" class="form-control" placeholder="Search" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Search" class="btn btn-success">
                        </div>
                    </form>
                </div>
                 <div class='response-message'></div>
                <div class='table-responsive' id="table-response">
                   
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