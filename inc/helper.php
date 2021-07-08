<?php

function render($file, $data = null){
	$data = $data;
	include($file);
}

function redirect($url){
	header("Location:".$url);
}

function dd($val){
	echo "<pre>";
	print_r($val);
	echo "</pre>";
	die();
}

function upload(){
	$tmp_name = $_FILES["file"]["tmp_name"];
	$filename = basename($_FILES["file"]["name"]);
	$target_dir = "uploads";
	move_uploaded_file($tmp_name, "$target_dir/$filename"); 
}