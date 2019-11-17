<?php
ob_start();
$pageTitle = 'Dashboard';
require_once 'init.php';
$admin = checkGuest();
$sql = 'SELECT products.id, sum(views.counter) AS total_views FROM products INNER JOIN views ON products.id = product_id WHERE movie = 1';
$movies = select_row($sql);

$sql = 'SELECT products.id, sum(views.counter) AS total_views FROM products INNER JOIN views ON products.id = product_id WHERE series = 1';
$series = select_row($sql);

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
                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="roles_view.php" class=' text-light'>
                                        <span class=""><?php echo totalRows('roles') ?></span>
                                        <i class="fas fa-plus fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Roles</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="users_view.php" class=' text-light'>
                                        <span class=""><?php echo totalRows('users') ?></span>
                                        <i class="fas fa-user fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Users</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="categories_view.php" class=' text-light'>
                                        <span class=""><?php echo totalRows('categories') ?></span>
                                        <i class="fas fa-folder fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Categories</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="subs_view.php" class=' text-light'>
                                        <span class=""><?php echo totalRows('sub_categories') ?></span>
                                        <i class="fas fa-file fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Sub-Categories</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="products_view.php" class=' text-light'>
                                        <span class=""><?php echo totalRows('products') ?></span>
                                        <i class="fas fa-film fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Products</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="#" class=' text-light'>
                                        <span class=""><?php echo totalRows('episode_product') ?></span>
                                        <i class="far fa-file-video fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Episode-Product</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="#" class=' text-light'>
                                        <span class=""><?php echo totalRows('url_product') ?></span>
                                        <i class="fas fa-tags fa-fw fa-2x"></i><br>
                                    </a>
                                    <b>Producds-Links</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->

                            <!-- START GROUP-INFO -->
                            <div class="col-md-3 mb-4  group">
                                <div class="info-group container text-center">
                                    <div class="info">
                                    <a href="#" class=' text-light' title='<?php echo countWithoutFormat('counter', 'views') ?>'>
                                        <span class="" ><?php echo countRows('counter', 'views'); ?></span>
                                        <i class="fas fa-eye fa-fw fa-2x"></i><br>
                                    </a>
                                    <b> Total-Views</b>
                                    </div>
                                    </div>
                                </div>
                            <!-- END GROUP-INFO -->
                            <hr class='hr'>


                            <!-- START LASTEST 5 -->
                                <div class="col-md-6 mt-5 lastest">
                                <!-- START CARD -->
                                    <div class="card text-white bg-dark">
                                        <h5 class="card-header">Latest Products
                                            <span class="toggel-info float-right">
                                                <i class="fas fa-minus fa-lg"></i>
                                            </span>
                                        </h5>

                                        <div class="card-body">
                                            <ul class='lastest'>

                                                <?php
                                                $products = lastestRows('id,name,active,movie,series', 'products', 'id', 5);
                                                foreach ($products as $prod):
                                                ?>
                                                <!-- START LAST ITEM -->
                                                <li class='row mb-2 child-link'>
                                                <div class="name col-md-8 row">
                                                    <b class="col-md-8"> <?php echo $prod['name'] ?> </b>
                                                    <b class="col-md-4">
                                                        <?php
                                                        if ($prod['movie'] == 1):
                                                            echo "<span class='badge badge-primary'>Movie</span>";
                                                        elseif ($prod['movie'] == 0 && $prod['series'] == 1):
                                                            echo "<span class='badge badge-warning'>Series</span>";
                                                        endif;
                                                        ?>
                                                    </b>
                                                </div>
                                                <div class='group-action col-md-4 text-right show-action'>
                                                    <a href="process\products_process.php\active\<?php echo $prod['id'] ?>" class='action  mr-1 fa fa-check-circle <?php echo $prod['active'] == 1 ? 'text-success' : 'text-muted'; ?>'></a>
                                                    <a href="product_edit.php?id=<?php echo $prod['id'] ?>" class='action far fa-edit text-primary mr-1'></a>
                                                </div>
                                                </li>
                                                <!-- END LAST ITEM -->
                                                <?php endforeach?>
                                            </ul>
                                            <a href="products_view.php" class="btn btn-primary btn-sm">More</a>
                                        </div>
                                    </div>
                                <!-- END CARD -->
                                </div>
                            <!-- END LASTEST 5 -->

                            <!-- START LASTEST 5 -->
                            <div class="col-md-6 mt-5 lastest">
                                <!-- START CARD -->
                                    <div class="card text-white bg-dark">
                                        <h5 class="card-header">Latest Categories
                                            <span class="toggel-info float-right">
                                                <i class="fas fa-minus fa-lg"></i>
                                            </span>
                                        </h5>
                                        <div class="card-body">
                                            <ul class='lastest'>
                                                <?php
                                                $categories = lastestRows('id,name,active', 'categories', 'id', 5);
                                                foreach ($categories as $cat):
                                                ?>
                                                <!-- START LAST ITEM -->
                                                <li class='row mb-2 child-link'>
                                                <div class="name col-md-8 row">
                                                    <b class="col-md-8"> <?php echo $cat['name'] ?> </b>
                                                </div>
                                                <div class='group-action col-md-4 text-right show-action'>
                                                    <a href="process\categories_process.php\active\<?php echo $cat['id'] ?>" class='action  mr-1 fa fa-check-circle <?php echo $cat['active'] == 1 ? 'text-success' : 'text-muted'; ?>'></a>
                                                    <a href="category_edit.php?id=<?php echo $cat['id'] ?>" class='action far fa-edit text-primary mr-1'></a>
                                                </div>
                                                </li>
                                                <!-- END LAST ITEM -->
                                                <?php endforeach?>
                                            </ul>
                                            <a href="categories_view.php" class="btn btn-primary btn-sm">More</a>
                                        </div>
                                    </div>
                                <!-- END CARD -->
                                </div>
                            <!-- END LASTEST 5 -->

                        <!-- START LASTEST 5 -->
                        <div class="col-md-6 mt-5 lastest">
                                <!-- START CARD -->
                                    <div class="card text-white bg-dark">
                                        <h5 class="card-header">Latest Episode-Product
                                            <span class="toggel-info float-right">
                                                <i class="fas fa-minus fa-lg"></i>
                                            </span>
                                        </h5>
                                        <div class="card-body">
                                            <ul class='lastest'>
                                                <?php
                                                $sql = "SELECT episode_product.* ,products.name AS prod_name FROM episode_product INNER JOIN products ON product_id = products.id ORDER BY id DESC LIMIT 5";
                                                $episodes = select_rows($sql);
                                                foreach ($episodes as $epis):
                                                ?>
                                                <!-- START LAST ITEM -->
                                                <li class='row mb-2 child-link'>
                                                <div class="name col-md-8 row">
                                                    <b class="col-md-8"> <?php echo $epis['prod_name'] ?> </b>
                                                    <b class="col-md-4">
                                                        <?php echo $epis['name'] ?>
                                                    </b>
                                                </div>
                                                <div class='group-action col-md-4 text-right show-action'>
                                                    <a href="process\episodes_process.php\active\<?php echo $epis['id'] ?>" class='action  mr-1 fa fa-check-circle <?php echo $epis['active'] == 1 ? 'text-success' : 'text-muted'; ?>'></a>
                                                    <a href="episode_edit.php?id=<?php echo $epis['id'] ?>" class='action far fa-edit text-primary mr-1'></a>
                                                </div>
                                                </li>
                                                <!-- END LAST ITEM -->
                                                <?php endforeach?>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                <!-- END CARD -->
                                </div>
                            <!-- END LASTEST 5 -->

                            <!-- START LASTEST 5 -->
                            <div class="col-md-6 mt-5 lastest">
                                    <!-- START CARD -->
                                        <div class="card text-white bg-dark">
                                            <h5 class="card-header">Top Viewers
                                                <span class="toggel-info float-right">
                                                    <i class="fas fa-minus fa-lg"></i>
                                                </span>
                                            </h5>
                                            <div class="card-body">
                                                <ul class='lastest'>
                                                    <?php

                                                    $views = lastestRows("id,name,counter", 'views','counter',5);
                                                    foreach ($views as $view):
                                                    ?>
                                                    <!-- START LAST ITEM -->
                                                    <li class='row mb-2'>
                                                    <div class="name col-md-8 row">
                                                        <b class="col-md-8"> <?php echo $view['name'] ?> </b>
                                                        <b class="col-md-4">
                                                            
                                                        </b>
                                                    </div>
                                                    <div class='group-action col-md-4 text-right '>
                                                        <?php echo formatNumber($view['counter']) . '<b class="text-success"> Views </b>'?>    
                                                    </div>
                                                    </li>
                                                    <!-- END LAST ITEM -->
                                                    <?php endforeach?>
                                                </ul>
                                            </div>
                                        </div>
                                    <!-- END CARD -->
                                    </div>
                                <!-- END LASTEST 5 -->
                                <hr class='hr'>
                                <!-- START CHART JS -->
                                <div class="chart col-md-6">    
                                    <div class="card text-white bg-dark">
                                        <div class="card-header">
                                            Views %
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Views Between Movies & Series </h5>
                                            <canvas id="movie-series"></canvas>    
                                        </div>
                                    </div>
                                </div>
                                <!-- END CHART JS -->


                                <!-- START CHART JS -->
                                <div class='chart col-md-6'>
                                    <div class="card text-white bg-dark ">
                                        <div class="card-header">
                                            Movies
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"> Top Five Movies & Series  View</h5>
                                            <canvas id="topFive"></canvas>    
                                        </div>
                                    </div>
                                </div>
                                <!-- END CHART JS -->
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
<script>
// Views Series And Movies
var ctx = document.getElementById('movie-series').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['Moives', 'Series'],
        datasets: [{
            
            backgroundColor: ['#E56A1E','#31054A'],
            
            borderColor: 'rgb(255,255,255)',
            data: [<?php echo $movies['total_views'] ?>,<?php echo $series['total_views']?>]
        }]
    },
    
    
    // Configuration options go here
    options: {}
    });
    
// End views Serires And Movies

// Start Top Five Movies 
var ctx = document.getElementById('topFive').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',
    
    // The data for our dataset
    data: {
        labels: [
            
            <?php
            $views = lastestRows("name,counter", 'views','counter',5);
            ?>
            '<?php echo $views[0]['name']?>',
            '<?php echo $views[1]['name']?>',
            '<?php echo $views[2]['name']?>',
            '<?php echo $views[3]['name']?>',
            '<?php echo $views[4]['name']?>',
        ],
        datasets: [{
            
            backgroundColor: [
                '#E56A1E',
                '#EE7879',
                '#FCC133',
                'rgba(153, 102, 255, 1)',
                '#3EB650',

            ],
            
            borderColor: 'rgb(255,255,255)',
            data: [
            '<?php echo $views[0]['counter']?>',
            '<?php echo $views[1]['counter']?>',
            '<?php echo $views[2]['counter']?>',
            '<?php echo $views[3]['counter']?>',
            '<?php echo $views[4]['counter']?>',
            ]
        }]
    },
    
    
    // Configuration options go here
    options: {
        scales: {
        yAxes: [{
            
                ticks: {
                    beginAtZero: true
                }
            }]
        }
        }
    });
// End top Five Movies
</script>