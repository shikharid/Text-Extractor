<?php
	include_once('dao/uploaddao.php');
	session_start();
	error_reporting(E_ALL);
    ini_set("display_errors", 1);
    $name = $_FILES["file-path"]["name"];
    $filePath = $_FILES["file-path"]["tmp_name"];
    $src = $filePath;
    $uploadObject = new uploadDoc;
    $dst = "C:/xampp/htdocs/xampp/text/result/".$name;
    $imageDst = "C:/xampp/htdocs/xampp/text/upload/".$name;
    $uploadObject -> saveToDirectory($filePath, $imageDst);
    $cmd = "C:/xampp/htdocs/xampp/text/executable/extractor.exe {$imageDst} {$dst}";
    exec($cmd);
    $dst .= ".txt";
    $imageDst = "upload/".$name;
    $x = $uploadObject -> uploadToDB($imageDst,$dst);
   	$_SESSION['id'] = $x;
   	header("location:index.php");
    exit();
 ?>