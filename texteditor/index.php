
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="css/site.css">
<link rel="stylesheet" href="css/richtext.min.css">

<script src="js/jquery.min.js"></script>
<script src="js/jquery.richtext.js"></script>

</head>
<body>
<div class="container-fluid">

 
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-8">

<h2>this is rich text editor</h2>
 <form class="" action='' method="post" >
 <!-----------------pseodo text area-------->
 <textarea id="php_post_text" name="php_post_text" placeholder="blog Description" class="form-control " style="display:none;"></textarea>
 <!----------------MAIN TEXT EDITOR-------->
<textarea id ="y" class="form-control content" name="example"></textarea>
<!---------------ON SUBMIT ASIGN VALUE OF PSEOUDO TEXT AREA WITH TEXT EDITOR-------->
<input type="submit"  value="TEST ME" class="btn btn-info " name="save_text" onclick="$('#php_post_text').val($('.content').val());">

 </form>
 </div>
 <div class="col-md-2">
</div>
 </div></div>
 </body>
 <script>
    $(document).ready(function(){
     $('.content').richText();
	});
</script>		
 </html>
 <div onclass="jumbotron-fluid" style="">
 <h4 class="text-center"> your text editor content will print here</h4>
 <div class="text-center">
 </div>
 
 <?php
 // get value of text-editor and print
 if(isset($_POST['save_text']))
 {
     $php_post_text=$_POST['php_post_text'];
     echo '<div class="text-center">'.$php_post_text.'</div>';
 }
 ?>
 </div>
 