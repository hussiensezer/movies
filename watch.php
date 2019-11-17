<?php
$pageTitle = isset($_GET['w']) && !empty($_GET['w']) ? filter_var($_GET['w'],FILTER_SANITIZE_STRING) : 'ElJoker-Movies';
require 'init.php';


$id = isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ? filter_var(intval($_GET['id']),FILTER_SANITIZE_NUMBER_INT) : 0;
// LINK
$sql = "SELECT link FROM url_product WHERE id = $id AND active = 1";
$link = select_row($sql);

if(empty($link)):
    include "404.php";
else:


?>

<div class="watching">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5 mb-5">
            <iframe src="<?php echo $link['link']?>" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" width="100%" frameborder="0" height="500" rel="nofollow"></iframe>

            </div>
        </div>
    </div>
</div>


















<?php
include $tpl . 'footer.php';
endif;
?>