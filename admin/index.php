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
            <div class='col-md-12'>
                <h1 class='text-center'>Hellow</h1>
                <?php
                    view_alerts();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- END RIGHT SIDE -->

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>