<?php
ob_start();
$pageTitle = isset($_GET['name']) ? $_GET['name'] : 'El-Joker Movies';
require 'init.php';

$sql = "SELECT * FROM products WHERE sub_category_id = {$_GET['id']} AND active = 1";
$pagination = pagination('products',$sql, 20);
$products = $pagination['date'];
$buttons = $pagination['button'];
?>

<!--START FEATUER DIV -->
<div class="featuer text-white  pt-2" dir="rtl">
	<div class="container">
		<div class="row">
			<div class="col-12">

				<h1 class="d-flex justify-content-start "> Feature News</h1>
				<div class="upp">
					<div class="overlay"></div>
				<div id="myCarousel" class="carousel slide" data-ride="carousel" data-wrap="true" data-interval="4000">
				<ul class="carousel-indicators">

				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
				<li data-target="#myCarousel" data-slide-to="4"></li>
				</ul>
				<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">

					<img class="d-block w-100" src="assets/images/moroko.jpg" alt="First slide">
					<div class="carousel-caption d-none d-block">
					<p>prosted by <span>admin . febraury 17,2016</span> </p>
					<h1>Broken Filem 2013</h1>

					</div>
				</div>
				<div class="carousel-item">

					<img class="d-block w-100" src="assets/images/n.jpg" alt="Second slide">
					<div class="carousel-caption d-none d-block">
						<p>prosted by <span>admin . febraury 17,2016</span> </p>
					<h1>Broken Filem 2014</h1>
				</div>
				</div>
				<div class="carousel-item">

					<img class="d-block w-100" src="assets/images/shahid8.jpg" alt="Third slide">
					<div class="carousel-caption d-none d-block">
					<p>prosted by <span>admin . febraury 17,2016</span> </p>
					<h1>Broken Filem 2015</h1>
					</div>
				</div>
				<div class="carousel-item">

					<img class="d-block w-100" src="assets/images/shahid11.jpg" alt="First slide">
					<div class="carousel-caption d-none d-block">
					<p>prosted by <span>admin . febraury 17,2016</span> </p>
					<h1>Broken Filem 2016</h1>
					</div>
				</div>
				<div class="carousel-item">

					<img class="d-block w-100" src="assets/images/jaqu.jpg" alt="Second slide">
					<div class="carousel-caption d-none d-block">
						<p>prosted by <span>admin . febraury 17,2016</span> </p>
					<h1>Broken Filem 2017</h1>
				</div>
				</div>
				</div>

				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<!--END FEATUER DIV -->



<!-- START PRODUCTS -->
<div class='products col-md-12 mt-5 mb-5'>
	<div class="container">
		<div class="row">
		<?php
			foreach($products as $product):
		?>
			<!-- START PRODUCT -->
			<div class="product col-md-3 mt-2 mb-2">
				<div class="details">
					<img src="uploads/posters/<?php echo $product['avatar']?>" alt="poster" \>
					<div class="overlay-details">
						<p class=''> <?php echo $product['name']?> </p>
						<p class='description'> <?php echo $product['description']?> </p>
					</div>
				</div>
				<div class="product-info container col-md-12">
					<div class="row">
						<div class="col-md-6">
							<i class="fas fa-eye fa-fw"></i>
							<span class="views">
								<?php 
									$sql = "SELECT counter FROM views WHERE active = 1 AND product_id = {$product['id']}";
									$view = select_row($sql);
									echo $view['counter'];
								?>
							</span>
						</div>
						<?php
							if($product['movie'] == 1) :
							echo "<b class='col-md-6 text-left'>New</b>";
							else:
						?>
						<?php
								
						?>
						<div class="col-md-6 text-left">
							<i class="fas fa-video"></i>
							<span class="episode">4</span>
						</div>
					<?php
					endif;
					?>
					</div>
				</div>
			</div>
		<?php
			endforeach;
		?>
		<!-- END PRODUCTS -->
	</div>
		<?php
			echo $buttons;
		?>
			
	</div>
</div>
<!-- END PRODUCTS -->
















<?php

include $tpl . "footer.php";
ob_end_flush();
?>