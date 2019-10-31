<?php
ob_start();
$pageTitle = 'Dashboard';
require_once 'init.php';
$admin = checkGuest();


?>

<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5 mb-5'>
                <h1 class='text-center'>Dashboard</h1>
                <?php
                    view_alerts();
                ?>
            </div>
                <div class="counting col-md-12 mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="users_view.php" class=' text-light'>
                                        <span class="">10000</span>
                                        <i class="fas fa-user fa-fw fa-5x"></i><br>
                                    </a>
                                    <b> Users</b>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>    
            </div>
    </div>
</div>
<!-- END RIGHT SIDE -->

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>