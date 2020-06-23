<?php
ob_start();
$pageTitle = 'Searching';
require 'init.php';

$search = isset($_GET['search']) && !empty($_GET['search']) ? filter_var($_GET['search'], FILTER_SANITIZE_STRING) : '';
$tag = isset($_GET['tag']) && !empty($_GET['tag']) ? filter_var($_GET['tag'], FILTER_SANITIZE_STRING) : '';


if($search != ''):
    $like = "name LIKE '%$search%' OR year LIKE '%$search%' OR tags LIKE '%$search%' ";
    $parameters = "&search={$search}";
elseif($tag != ''):
    $like = "tags LIKE '%$tag%'";
    $parameters = "tag={$tag}";
else:
    $like = ' id = 0';
    $parameters ='';
endif;


$table = "products WHERE {$like} ORDER BY show_up DESC"; 
$sql = "SELECT id,name,avatar FROM products WHERE {$like}  AND active = 1 ORDER BY show_up DESC";
$amount = 20;
$pagination = pagination($table,$sql,$parameters,$amount);

$products = $pagination['date'];
$buttons = $pagination['button'];
if(empty($products)):
    echo "<div class='alert alert-warning mt-5 mb-5'> لا توجد نتائج</div>";
else:
?>


<div class="search mt-5 mb-5 pt-5 pb-5">
    <div class="container">
        <div class="row">
        <?php
			foreach($products as $product):
		?>
			<!-- START PRODUCT -->
			<div class="product col-md-3 mt-2 mb-2">
				<div class="details">
					<a href="product.php?id=<?php echo $product['id'] . "&watch=" . str_replace(' ','-',$product['name'])?> ">
						<img src="uploads/posters/<?php echo $product['avatar']?>" alt="poster" \>
					</a>
					<div class="overlay-details">
						<p class=''> <?php echo $product['name']?> </p>
					</div>
				</div>
			</div>
		<!-- END PRODUCTS -->
		<?php
        endforeach;
			
		?>
        </div>
    <?php
    echo $buttons;
    ?>
    </div>
</div>

<?php
include $tpl . 'footer.php';
endif;
?>