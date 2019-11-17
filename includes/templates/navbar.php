<?php 
$sql = 'SELECT name,id FROM categories WHERE active = 1';
$categories = select_rows($sql);


?>
<div class="upper-section mb-2">
	<div class="container">
		<div class="row">
		<div class="col-md-6">
			<form class="row" action="search.php" method="GET">
				<div class="form-group mt-3 ml-3 search">
					<input type="search" placeholder='ابحث عن' name="search" class='form-control  bg-dark text-white' required="required" autocomplete="off">
				</div>
				<input type="submit"  class="btn btn-info h-50 btn-md mt-3" value="Search">
			</form>
		</div>
		<div class="col-md-6 mt-3 ">
		<ul class="social row float-left">
				<li class="">
					<a href="#" >
						<span></span>
						<span></span>
						<span class="fab fa-facebook-f"></span>
					</a>
				</li>
				<li class="">
					<a href="#" >  
						<span></span>
						<span></span>
						<span class="fab fa-google-plus-g"></span>
					</a>
				</li>
				<li>
					<a href="#">
						<span></span>
						<span></span>
						<span class="fab fa-linkedin-in"></span>
					</a>
				</li>
			</ul>
		</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-expand-md navbar-light ">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="index.php"><h2><span class="type"></span></h2></a>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		<?php 
			foreach($categories as $cate):
				
			$sqlSub = "SELECT name ,id FROM sub_categories WHERE active = 1 AND category_id = {$cate['id']}";
			$subs = select_rows($sqlSub);
			if(count($subs) > 1 ):
		?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href='#'  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $cate['name']?>
				</>
				<div class="dropdown-menu menu-bg" aria-labelledby="navbarDropdown">
				<?php
					foreach($subs as $sub):
						$strReplace = str_replace(' ', '-', $sub['name']);
					?>
				<a class="dropdown-item" href="cate.php?id=<?php echo $sub['id'] . "&name=" . $strReplace?>"><?php echo $sub['name']?>  </a>
				<?php
					endforeach;
				?>
				
				</div>
			</li>
				
			<?php else:
				foreach($subs as $sub):
					$strReplace = str_replace(' ', '-', $sub['name']);
				?>
			<li class="nav-item">
				<a class="nav-link " href="cate.php?id=<?php echo $sub['id'] . "&name=" . $strReplace?>"><?php echo $cate['name']?>  </a>
			</li>
			<?php
				endforeach;
				endif;
			endforeach;?>
			
				
		</ul>
		</div>
	</nav>

<!-- END NAV BAR -->