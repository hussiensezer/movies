<?php
ob_start();
$pageTitle = 'Products';
include 'init.php';
checkGuest();
$active = isset($_GET['active']) && !empty($_GET['active']) ? "WHERE `active` = 0" : '';

// TO CHANGE BETWEEN MOVIES AND SERIES
$prod = '';
if(isset($_GET['prod']) && $_GET['prod'] == 'movies'){
    $prod = 'WHERE movie = 1';
}elseif(isset($_GET['prod']) && $_GET['prod'] == 'series') {
    $prod = 'WHERE series = 1';
}


// SEARCH AND LIMIT OF SHOW
$searchQuery = '';
if(isset($_GET['q']) && !empty($_GET['q']) && is_string($_GET['q'])) {
$searchQuery = "WHERE products.name LIKE '%{$_GET['q']}%' OR year LIKE '%{$_GET['q']}%' OR products.active  LIKE '%{$_GET['q']}%' OR products.created_at LIKE '%{$_GET['q']}%' OR products.updated_at LIKE '%{$_GET['q']}%' OR description LIKE '%{$_GET['q']}%' OR tags LIKE '%{$_GET['q']}%' OR sub_categories.name LIKE '%{$_GET['q']}%' ";   
}

if(isset($_GET['limit']) && !empty($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = $_GET['limit'];
}

// FETCH ALL THE DATA SEND TO products_VIEW
$sql = "SELECT products.* , users.name AS created_by, sub_categories.name AS in_sub_cate  FROM products INNER JOIN users ON products.user_id =  users.id INNER JOIN sub_categories ON products.sub_category_id = sub_categories.id {$searchQuery} {$prod} ORDER BY id DESC";
$products = pagination('products',$sql )['date'];
$buttons = pagination('products', $sql)['button'];

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">

    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <div class="container mb-5 mt-5">
                    <form class="row">
                    <div class="col-col-md-4">
                    <a href='product_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New Product</a>
                    </div>
                        <div class="form-group col-md-4 offset-md-5">
                            <input type="search" name="q" class="form-control" placeholder="Search" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Search" class="btn btn-success">
                        </div>
                    </form>
                </div>
                <?php
                    view_alerts();
                ?>
                <div class='table-responsive'>
                    <table class='table table-hover table-dark  table-striped text-center'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Year</th>
                                <th>Product_Type</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($products as $index => $product) {?>
                                <tr>
                                <td><?php echo $index + 1 ;?></td>
                                <td><a class='text-light' href="episodes_view.php?id=<?php echo $product['id']?>"><?php echo $product['name'] ;?> </a></td>
                                <td>
                                    <a href='process\products_process.php\active\<?php echo $product['id']?>'>
                                        <span class='fa fa-check-circle <?php echo $product['active'] == 1 ? 'text-success' :'text-muted' ;?>'>
                                        </span>
                                    </a>
                                </td>
                                <td><?php echo $product['year'] ;?></td>
                                <td><?php  
                                    if($product['movie'] == 1){
                                        echo 'Movie';
                                    }else{
                                        echo 'Series';
                                    }
                                ?></td>
                                <td><?php echo $product['created_at'] ;?></td>
                                <td><?php echo $product['updated_at'] ;?></td>
                                <td>
                                    <a href='product_edit.php?id=<?php echo $product['id']?>' class='far fa-edit text-primary mr-2'></a>
                                    <a href='process\products_process.php\delete\<?php echo $product['id']?>' class='fa fa-times-circle text-danger confirmed'></a>
                                </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <?php
                    echo !empty($buttons) ? $buttons : '';
                    ?>
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