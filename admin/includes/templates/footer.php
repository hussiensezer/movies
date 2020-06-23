<!-- OUR SCRIPT -->
<script src="<?php echo $js . 'jquery-3.3.1.min.js'?>"> </script>
<script src="<?php echo $js . 'bootstrap.min.js'?>"> </script>
<script src="<?php echo $js . 'jquery.richtext.min.js'?>"> </script>
<script src="<?php echo $js . 'chart.js'?>"></script>
<?php
  if(isset($ajax)){
      echo "<script src='{$js}{$ajax}'></script>";
  }  
?>
<script src="<?php echo $js . 'main.js'?>"> </script>
</body>
</html>