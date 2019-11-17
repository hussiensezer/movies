<?php
ob_start();
$pageTitle = 'El-Joker Movies';
require 'init.php';

$sql = "SELECT * FROM products WHERE active = 1 ORDER BY show_up DESC";
$pagination = pagination('products',$sql, '',20);
$products = $pagination['date'];
$buttons = $pagination['button'];

?>

<!-- START ONE SECTION VIEWS -->
<div class="views text-white " dir="rtl">
	<div class="container ">
		<div class="row ">
			<!--START DIV one COL-LG-7-->
			<div class="col-lg-7 col-sm-12 p-0 ">
				<div class="cover">
					<a href="#" > action </a>
					<img src="assets/images/joker.jpg " alt="covermovie" class="image">
					<div class="overlay">
						<div class="text">
							<h3> الجوكر فيلم </h3>
							<span>22-10-2019</span>
							<i class="fas fa-share-alt"></i>
						</div>

					</div>
				</div>
			</div>
	<!--END DIV one COL-LG-7-->
	<!--START DIV one COL-LG-5-->
			<div class="col-lg-5 col-sm-12 p-0">
				<!--START PART DIV -->
				<div class="part bg-light">
					<div class="container">
					<div class="row">
							<div class="col-md-6 p-0 col-sm-12">
								<!-- START DIV PHOTO -->
								<div class="photo">
									<a href="#" > action </a>
									<img src="assets/images/wiki.jpg" alt="partmovie" class="image">
									<div class="overlay">
										<div class="text_part">
											<h6>الجوكر فيلم  </h6>
											<span>22-10-2019</span>
											<i class="fas fa-share-alt pb-3"></i>
										</div>

									</div>
								</div>
								<!--END DIV PHOTO -->
							</div>
							<div class="col-md-6 p-0 col-sm-12">
									<!--START DIV PHOTO -->
								<div class="photo">
									<a href="#" > action </a>
									<img src="assets/images/jk.jpg">
										<div class="overlay">
										<div class="text_part">
											<h6> الجوكر فيلم  </h6>
											<span>22-10-2019</span>
											<i class="fas fa-share-alt pb-3"></i>
										</div>
									</div>
								</div>
									<!--END DIV PHOTO -->
							</div>
							<div class="col-md-6 p-0 col-sm-12">
									<!--START DIV PHOTO -->
								<div class="photo">
									<a href="#" > action </a>
									<img src="assets/images/wiki.jpg" alt="partmovie" class="image">
										<div class="overlay">
										<div class="text_part ">
											<h6> الجوكر فيلم  </h6>
											<span>22-10-2019</span>
											<i class="fas fa-share-alt pb-3"></i>
										</div>
									</div>
								</div>
									<!--END DIV PHOTO -->
							</div>
							<div class="col-md-6  p-0 col-sm-12">
									<!--START DIV PHOTO -->
								<div class="photo">
									<a href="#" > action </a>
									<img src="assets/images/jk.jpg" alt="partmovie" class="image">
										<div class="overlay">
										<div class="text_part">
											<h6>الجوكر فيلم  </h6>
											<span>22-10-2019</span>
											<i class="fas fa-share-alt pb-3"></i>
										</div>

									</div>
								</div>
								<!--END DIV PHOTO -->
							</div>
						</div>
					</div>
				</div>
			<!-- END DIV PART -->
			</div>
			<!--END DIV one COL-LG-5-->
		</div>
	</div>
</div>
<!-- END ONE SECTION VIEWS -->
<!-- //////////////////////////////////////////////////////////////// -->
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
					<a href="product.php?id=<?php echo $product['id'] . "&watch=" . str_replace(' ','-',$product['name'])?> ">
						<img src="uploads/posters/<?php echo $product['avatar']?>" alt="poster" \>
					</a>
					<div class="overlay-details">
						<p class=''> <?php echo $product['name']?> </p>
						<p class='description'> <?php echo $product['description']?> </p>
					</div>
				</div>
				<!-- START PRODUCT-INFO -->
				<div class="product-info container col-md-12">
					<div class="row">
						
						<?php
							$episodes = totalRows("episode_product WHERE product_id = {$product['id']} AND  active = 1");
							if(empty($episodes)):
							echo"<small class='col-md-6 text-center text-muted'> جارى التحميل...</small>";
							else:
						?>
						<div class="col-md-4 ml-2 data">
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
							if($product['movie'] == 1 ) :
								if($product['year'] == date("Y")):
									echo "<b class='col-md-2 data text-center'>New</b>";
								endif;
							else:
						?>
						<div class="col-md-3 data text-center">
							<i class="fas fa-video fa-fw"></i>
							<span class="episode">
								<?php
								echo $episodes;
								?>
							</span>
						</div>
					<?php
						endif;// EMPTY EPISODES
					endif; // IF MOVIE  AND YEAR == SAME YEAR
					?>
					</div>
				</div>
			<!-- END PRODUCT-INFO -->
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
include $tpl . 'footer.php'; // For Navbar
ob_end_flush();
?>