<?php
	include_once './altconfig.inc.php';
	class viewDB{
		function showResult($id){
			global $db;
			$q = "SELECT * from history where id = ".$id;
			$result = $db -> get_results($q);
			foreach ( $result as $result ){
					   	// Access data using object syntax
					    return $result;

					}
			return $result;
		}
		function showAll(){
			global $db;
			$q = $db -> get_results("SELECT * from history");

			return $q;
		}
	}
?>