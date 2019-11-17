<?php
ob_start();
$pageTitle = isset($_GET['watch']) && !empty($_GET['watch']) ? filter_var($_GET['watch'],FILTER_SANITIZE_STRING	): 'Eljoker-Movies';
require "init.php";

$id = isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
// PRODUCTS
$sql = "SELECT * FROM products WHERE id = $id AND active = 1";
$prod = select_row($sql);

if(empty($prod)):
    include "404.php";
else:


// PRODUCTS_EPISODE
$sql = "SELECT name,id FROM episode_product  WHERE product_id = {$prod['id']} AND active = 1 ORDER BY id DESC";
$episodes = select_rows($sql);

// FOR UPDATE EACH VIST TO THE PRODUCT
$views = viewsCountUpdate('counter','views',$prod['id'],'product_id', 'counter');

?>

<div class="prod">
    <div class="container mt-5 mb-5">
        <div class="row">
    <!-- START TOP SECTION -->
        <!-- START LOGO -->
            <div class="col-md-6 offset-md-2 logo">
                <img src="uploads/posters/<?php echo $prod['avatar']?>" alt="logo">
            </div>
        <!-- END LOGO -->
            <div class="product-details col-md-4">
                <!-- START -->
                <div class="product-info h-0 col-md-12 mt-3 mb-3">
                    <span class="title">الاسم :- </span>
                    <span class="data"> <?php echo $prod['name']?></span>
                </div>
                <!-- END -->
                <!-- START -->
                <div class="product-info h-0 col-md-12 mt-3 mb-3">
                    <span class="title">عدد المشاهدات :- </span>
                    <span class="data"> <?php echo $views;?></span>
                </div>
                <!-- END -->

                <!-- START -->
                <div class="product-info col-md-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="title">انتاج :- </span>
                            <span class="data"> <?php echo $prod['year']?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="badge badge-warning">IMDB</span>
                            <span class="data"> :- <?php echo $prod['rate']?>/10</span>
                        </div>
                    </div>
                <!-- END -->
                <!-- START -->
                <div class="product-info h-0 col-md-12 mt-3 mb-3 row">
                    <span class="title">تاج  :-  &nbsp;</span>
                    <?php
                        $tags = $prod['tags'];
                        foreach(explode(',', $tags) as $tag):
                        echo "<a href='search.php?tag={$tag}' class='badge badge-primary badge-tags ml-2 mb-2'>$tag</a>";
                        endforeach;
                    ?>
                </div>
                <!-- END -->
                </div>
            </div>
        <!-- END TOP SECTION -->
            <div class="col-md-12 desc mt-5 mb-5">
                <?php 
                    echo $prod['description'];
                ?>
            </div>
        <!-- START SERVERS -->
        <div class="col-md-12 mt-5 mb-5">
            <div class="row">
                <?php 
                if(empty($episodes)):
                    echo "<div class='alert alert-primary'> جارى تحميل الحلقه الاول عد فى وقت لاحق</div>";
                else:
                    foreach($episodes as $epis):
                ?>
                <div class="col-md-12 text-center">
                    <p><?php echo $epis['name']?></p>
                    <div class="ul">
                        <ul>
                            <?php 
                            // PRODUCTS_EPISODE
                                $sql = "SELECT link,id FROM url_product  WHERE product_id = {$epis['id']} AND active = 1";
                                $links = select_rows($sql);
                                if(empty($links)):
                                    echo "<div class='alert alert-primary'> جارى رفع الحلقه على السلفرات الخاصه بنا عد فى وقت لاحق</div>";
                                else:
                                    foreach($links as $link):
                            ?>
                                <li>
                                    <a href="watch.php?id=<?php echo $link['id'] . "&w=" . str_replace(' ', '-',$prod['name']) . "&ep=" . str_replace(' ','-',$epis['name'])?>" class="btn btn-primary btn-md m-2"> السرفر</a>
                                </li>
                            <?php
                                endforeach;// LINK
                            endif; // EMPTY LINKS
                            ?>
                            <hr class="hr">

                        </ul>
                    </div>
                </div>
                <?php
                endforeach;// Epis
            endif; // Empty Episode
                ?>

            </div>
            
        </div>
        <!-- END SERVERS -->
        </div>
    </div>
</div>









<?php

include $tpl . 'footer.php';
            endif;
ob_end_flush()
?>