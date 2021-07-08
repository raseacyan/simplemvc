<?php

include('./vendor/class.database.php');

class Model{
	
	private $table = "models";
	public $id;
	public $short_text;
	public $long_text;
	public $number;
	public $file_path;
	public $created_on;


	public function get($id=null){	

		if($id){
			$db = Database::getInstance();
		    $conn = $db->getConnection(); 
		    $sql_query = "SELECT * FROM {$this->table} WHERE id={$id}";		  
		    $result = $conn->query($sql_query);

		    $model = new stdClass();	

		    if ($result->num_rows > 0) {	
			  $model = $result->fetch_object();
			}else{
				return false;
			}	
			
			$this->id = $model->id;
			$this->short_text = $model->short_text;
			$this->long_text = 	$model->long_text;
			$this->number = 	$model->number;
			$this->file_path = 	$model->file_path;
			$this->created_on = $model->created_on;

			return $model;
		}else{
			$models = array();

			$db = Database::getInstance();
		    $conn = $db->getConnection(); 
		    $sql_query = "SELECT * FROM {$this->table}";
		    $result = $conn->query($sql_query);

		    if ($result->num_rows > 0) {
		    	while($model = $result->fetch_object()) {
	    			array_push($models, $model);
	  			}		  	
			}			
			return  $models;
			}		
	}

	

	public function save($fields=null){
		if($id==null && $fields == null){
			$db = Database::getInstance();
		    $conn = $db->getConnection();

			$sql = "INSERT INTO {$this->table} (short_text, long_text, number, file_path)
			VALUES ('{$this->short_text}', '{$this->long_text}', '{$this->number}', '{$this->file_path}')";

			if ($conn->query($sql) === TRUE) {
			  return true;
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}else{
			$db = Database::getInstance();
		    $conn = $db->getConnection();

		    $keyval = "";
			foreach($fields as $key=>$val){
				$keyval .= " {$key}='{$val}',"; 
			}
			$keyval = substr($keyval,0,-1);

			$sql = "UPDATE {$this->table} SET {$keyval} WHERE id={$this->id}";

			if ($conn->query($sql) === TRUE) {
			  return true;
			} else {
			  echo "Error updating record: " . $conn->error;
			}
		}
	}

	public function delete($id){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$sql = "DELETE FROM {$this->table} WHERE id={$id}";	  
		$result = $conn->query($sql_query);

		if ($conn->query($sql) === TRUE) {
		  return true;
		} else {
		  echo "Error updating record: " . $conn->error;
		}

	}

	public function customQuery($query){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 

		return $this;
	}
}