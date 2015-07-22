<?php
	 session_start();
	include_once 'dao/querydao.php';
	$accessObject = new viewDB;
	if(isset($_GET['id']))
		$_SESSION['id'] = $_GET['id'];

?>
<!doctype html>
<html>
	<head>
		<title>  Text Extractor </title>
		<meta charset = "utf-8">
	    <meta name = "viewport" content="width=device-width, initial-scale=1">
	    <link rel = "stylesheet" href="lib/bootstrap.min.css">
	    <script src = "lib/jquery-1.11.3.min.js"> </script>
	    <script src = "lib/bootstrap.min.js"> </script>
	    <link rel = "stylesheet" href = "css/style.css" type="text/css">
	    <script src = "js/main.js"> </script>
	    <script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});

		</script>
	  
	</head>
	<body>
		<nav class = "navbar navbar-inverse" id = "head">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<a class = "navbar-brand" href = "#">Text Extractor </a>
			</div>
			<div>
				<ul class = "nav navbar-nav navbar-right">
					<li class = "active"><a href = "index.php"> Extract </a> </li>
					<li><a href = "history.php"> History </a> </li>
				</ul>
			</div>
		</div>
		</nav>

		<!--<?php
		$v = $_FILES["file-path"]["name"];
		if(strlen($v))
			echo "<div> <p>".$v."</p></div>";
		?>-->
		<div class = "container-fluid row page">
			<form role = "form" action = "submit.php" method = "POST" enctype="multipart/form-data">
			<div class = "col-md-5 col-offset-2 image-page ">
				<div class = "input-group row" id = "form-element">
					<span class = "input-group-addon glyphicon glyphicon-picture " title = "Select Image.Type should be jpg, jpeg, png" data-toggle = "tooltip" id = "file_addon"></span>
					<input type = "file" class = "form-control" name = "file-path" id = "file-path" placeholder = "Enter File Path" aria-describedby = "file_addon">
					<!-- <?php if(isset($_SESSION['filePath'])) echo 'value = "'.$_SESSION['filePath'].'"'; unset($_SESSION['filePath']); ?> -->
				</div>
				<div class = "row image-box" id = "image-box">
					<img id = "image-preview" class = "img-thumbnail" 
					<?php 
						if(isset($_SESSION['id'])){
							$result = $accessObject -> showResult($_SESSION['id']);
							echo 'src = "'.($result -> image).'"';
						}
					?> alt = "No File Chosen"></img>
				</div>
			</div>
			<div class = "col-md-1 submit-col">
				
				<button class = "btn btn-lg btn-primary" id = "submit" name = "submit"  area-describedby = "submit_addon">
					<span class = "input-group-addon  glyphicon glyphicon-text-width " title = "Start Extraction" data-toggle = "tooltip" id = "submit_addon"></span>
				</button>
			</div>
			</form>
			<div class = "col-md-6 text-page">
				<?php 
					if(isset($_SESSION['id'])){
						echo '<script>
							$(document).ready(function(){
							$("#result").show(500);	});								</script>';
					}
					else{
						echo '<script>
							$(document).ready(function(){
							$("#result").hide();	});								</script>';
					}
				?>
				<div style = "text-align:center;"><span class = "glyphicon glyphicon-file " title = "Extracted Text Will Be Shown Here" data-toggle = "tooltip" id = "file_addon"></span></div>
				<textarea rows = "20" cols = "70" id = "result">

					<?php 
						if(isset($_SESSION['id'])){
							$result = $accessObject -> showResult($_SESSION['id']);
							
							echo file_get_contents($result -> output);
							unset($_SESSION['id']);
						}
					?>
				</textarea>
			</div>
		</div>
	</body>
</html>


