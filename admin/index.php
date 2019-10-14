<?php
$pageTitle = 'Dashboard';
require_once 'init.php';
$admin = checkGuest();


?>

<!-- START RIGHT SIDE -->
<div class="right-side full-width">
    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12'>
                <h1 class='text-center'>Roles</h1>
            </div>
        </div>
    </div>
</div>
<!-- END RIGHT SIDE -->

<?php
include $tpl . 'footer.php'; 
?>