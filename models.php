<?php

include('inc/helper.php');
include('models/class.model.php');

$whiteList = array('add','create','edit','update','delete');

$action = isset($_GET['action'])? in_array(strtolower($_GET['action']), $whiteList)? strtolower($_GET['action']) : false : false ;



$requestMethod = $_SERVER['REQUEST_METHOD'];

$submit = isset($_POST['submit'])? in_array(strtolower($_POST['submit']), $whiteList)? strtolower($_POST['submit']) : false : false ;




//read
if($requestMethod === 'GET' && !$action){
	$id = isset($_GET['id'])? $_GET['id'] : false;
	//single blog
	if($id){
		$m = new Model();
		$model = $m->get($id);	
		$data = $model;	
		render('views/models/single.php', $data);		
	}
	//all blogs
	else{
		$m = new Model();
		$models = $m->get();
		$data['models'] = $models;
		render('views/models/models.php', $data);
	}	
}

//add form
if($requestMethod === 'GET' && $action == 'add'){
	render('views/models/add.php');
}


//create: handle for add form
if($requestMethod === 'POST' && $submit == 'create'){


	$m = new Model();
	$m->short_text = $_POST['short_text'];
	$m->long_text = $_POST['long_text'];
	$m->number = $_POST['number'];

	$tmp_name = $_FILES["file"]["tmp_name"];
	$filename = basename(time()."_".$_FILES["file"]["name"]);
	$target_dir = "uploads";
	move_uploaded_file($tmp_name, "$target_dir/$filename"); 

	$m->file_path = $filename;
	
	$m->save();

	redirect('models.php');
}


//edit form
if($requestMethod === 'GET' && $action == 'edit'){

	$id = isset($_GET['id'])? $_GET['id'] : false;
	if($id){
		$m = new Model();
		$model = $m->get($id);
		$data = $model;
		render('views/models/edit.php', $data);
	}else{
		echo "no record";
	}	
}

//update: handle for edit form
if($requestMethod === 'POST' && $submit == 'update'){

	$id = $_POST['id'];
	$short_text = $_POST['short_text'];
	$long_text = $_POST['long_text'];
	$number = $_POST['number'];

	if($_FILES['file']['size'] == 0 && $_FILES['file']['error'] == 4){
		$file_path = $_POST['old_file_path'];
	}else{
		$old_file = $_POST['old_file_path'];

		$tmp_name = $_FILES["file"]["tmp_name"];
		$filename = basename(time()."_".$_FILES["file"]["name"]);

		$target_dir = "uploads";
		unlink("$target_dir/$old_file"); 
		move_uploaded_file($tmp_name, "$target_dir/$filename");

		$file_path = $filename;
	}

	$temp_fields = array('short_text'=>$short_text, 'long_text'=>$long_text, 'number'=>$number, 'file_path'=>$file_path);

	$m = new Model();
	$m->get($id);

	$fields = array();

	foreach($temp_fields as $key => $value){
		if($temp_fields[$key] != $m->$key) {
			$fields[$key] = $value;
		}
	}

	$m->save($fields);
	
	redirect('models.php');
}

//delete
if($requestMethod === 'GET' && $action == 'delete'){
	$id = isset($_GET['id'])? $_GET['id'] : false;
	if($id){
		$m = new Model();		
		$m->delete($id);
		redirect('models.php');
	}else{
		echo "no record";
	}	
}

