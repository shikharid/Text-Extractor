<?php
	include_once './altconfig.inc.php';
	class uploadDoc{

		function uploadToDB($image,$output){
			global $db;
			$db -> query("INSERT INTO history(id, image, output) values('','{$image}','$output')");
			$val = $db -> get_results("SELECT id from history ORDER BY id desc");
			return $val[0] -> id;
		}
		function saveToDirectory($imageBasePath, $imageFilePath){
			move_uploaded_file($imageBasePath, $imageFilePath);
		}

	}
?>