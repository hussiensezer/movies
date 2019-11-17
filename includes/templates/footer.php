<?php 
$sql = 'SELECT * FROM sub_categories';
$subs = select_rows($sql);

$count = ceil(count($subs) / 2);

$chunks = array_chunk($subs,$count);


?>
<!--START FOOTER-->
<div class="foot text-center" dir="rtl">

	<div class="container">
		<div class="all">
		<div class="row">
			<div class="col-12 mb-5">
				<ul class="nav justify-content-center">
				<?php 
				$sql = 'SELECT name,id FROM categories WHERE active = 1';
				$categories = select_rows($sql);
				foreach($categories as $cate):
					$sqlSub = "SELECT name ,id FROM sub_categories WHERE active = 1 AND category_id = {$cate['id']}";
					$subs = select_rows($sqlSub);
					if(count($subs) > 1 ):
				?>
					<!-- START NAV -->
                    <li class="nav-item">
				
						<div class="btn-group">
							<button type="button" class="btn btn-muted drop dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $cate['name']?>
							</button>
							<span class="one"></span>
							<span class="two"></span>
							<span class="there"></span>
							<div class="dropdown-menu menu-bg">
							<?php 
								foreach($subs as $sub):
									echo"<a class='dropdown-item' href='cate.php?id={$sub['id']}". "&name=" . str_replace(' ', '-', $sub['name']). "'>";
									echo $sub['name'];
									echo"</a>";
								endforeach;
							?>
								

							</div>
						</div>
					</li>
					<?php
						else:
					?> 
					<div class="btn-group">
					<?php
						foreach($subs as $sub):
					?>
						<a href="cate.php?id=<?php echo $sub['id'] . "&name=" .str_replace(' ', '-', $sub['name']) ?>" class="btn btn-muted drop"><?php echo $cate['name']?></a>
					<?php
						endforeach;
					?>
						<span class="one"></span>
						<span class="two"></span>
						<span class="there"></span>
					</div>
					<!-- END NAV -->
				<?php
					endif;
					endforeach;
				?>
				</ul>
			</div>
			<div class="col-md-3 ">
			<h5 class="text-center pb-3 pt-2" dir="rtl">مشاركة </h5>

				<div class="social col">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-skype"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-youtube"></i></a>
					<a href="#"><i class="fab fa-google"></i></a>

				</div>
			</div>
			<div class="col-md-3">
				<h5 class="text-center pb-3 pt-2" dir="rtl">معلومات عن  </h5>
				<div class="tag">

					<a href="#"> اكشن  </a>
					<a href="#">كوميدى  </a>
					<a href="#"> رومانسي  </a>
					<a href="#"> عائلى  </a>
					<a href="#"> دراما  </a>
					<a href="#">سيراه ذاتية </a>
					<a href="#"> غموض </a>
					<a href="#"> رعب  </a>
					<a href="#">تشويق</a>
					<a href="#">اثارة</a>
					<a href="#">خيال علمى</a>
					<a href="#">فنتازيا</a>

					
				</div>
			</div>
			<div class="col-md-3 ">
				<h5 class="text-center pb-3 pt-2"> الاقسام  </h5>
				<div class="works">
					<?php
					foreach($chunks[0] as $chunk):
						$strReplace = str_replace(' ', '-', $chunk['name']);
						echo "<a href='cate.php?id={$chunk['id']}&name={$strReplace}'>{$chunk['name']}</a>";
					endforeach;
					?>
				</div>
			</div>
			<div class="col-md-3 ">
				<h5 class="text-center pb-3 pt-2"> الاقسام  </h5>
				<div class="works">
					<?php
					foreach($chunks[1] as $chunk):
						echo "<a href='cate.php?id={$chunk['id']}&name={$strReplace}'>{$chunk['name']}</a>";
					endforeach;
					?>
				</div>
			</div>
				
		</div>
	</div>
	
	<div class="footer p-5 text-left">
		<span>© 2019 MovieLine, Inc. All Rights Reserved.</span>
	</div>
</div>
</div>

<!--END FOOTER-->




<!-- OUR SCRIPT -->
<script src="assets/js/jquery-3.3.1.min.js"> </script>
<script src="assets/js/bootstrap.bundle.min.js"> </script>
<script src="assets/js/bootstrap.min.js"> </script>
<script src="assets/js/typed.js"></script>
<script src="assets/js/main.js"> </script>
</body>
</html>
<?php

?>