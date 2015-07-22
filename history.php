<!doctype html>
<?php
	include_once 'dao/querydao.php';
	$accessObject = new viewDB;
?>

<html>
	<head>
		<title>  Text Extractor </title>
		<meta charset = "utf-8">
	    <meta name = "viewport" content="width=device-width, initial-scale=1">
	    <link rel = "stylesheet" href="lib/bootstrap.min.css">
	    <script src = "lib/jquery-1.11.3.min.js"> </script>
	    <script src = "lib/bootstrap.min.js"> </script>
	    <link rel = "stylesheet" href = "css/style.css" type="text/css">
	    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="lib/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="lib/jasny-bootstrap.min.js"></script>
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
		<div id = "table-view" class = "table-responsive" name = "record-view">
			<table class = "table table-hover table-striped rowlink" data-link = "row">
				<thead>
	        		<tr>
	           			<th>ID</th>
	            		<th>Image</th>
	       			 </tr>
	    		</thead>
				<?php
					$record = $accessObject -> showAll();
					foreach ( $record as $record ){
					   	// Access data using object syntax
					    echo '<tr>';
					    echo '<th><a href = "index.php?id='.$record -> id.'">'.$record -> id.'</a></th>';
					    echo '<th>'.$record -> image.'</th>';
					    echo '</tr>';

					}
				?>
			</table>
		</div>
	</body>
<html>