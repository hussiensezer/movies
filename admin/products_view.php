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
// FETCH ALL THE DATA SEND TO products_VIEW
$sql = "SELECT products.* , users.name AS created_by, sub_categories.name AS in_sub_cate  FROM products INNER JOIN users ON products.user_id =  users.id INNER JOIN sub_categories ON products.sub_category_id = sub_categories.id {$prod} ORDER BY id DESC";
$products = select_rows($sql);

?>


<!-- START RIGHT SIDE -->
<div class="right-side full-width">

    <div class="container-fluid">
        <div class="row">
            <div class='col-md-12 mt-5'>
                <h1 class='text-center'><?php echo $pageTitle ?></h1>
                <?php
                    view_alerts();
                ?>
                <a href='product_create.php' class='btn btn-success  mb-2'> <i class="fas fa-plus mr-1"></i>New Product</a>
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
                                <td><a class='text-light' href="product_details.php?id=<?php echo $product['id']?>"><?php echo $product['name'] ;?> </a></td>
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