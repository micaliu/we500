<?php
require_once('inc/bootstrap.php');
// function isInputValid($data){
// 	$requiredFields = array('name','link','overview','position','status');
// 	foreach($requiredFields as $field){
// 		if(empty($data[$field])){
// 			return false;
// 		}
// 	}
// 	return true;
// }

if(!empty($_POST)){
	print_r($_POST);

	try{
		// $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$statement = $dbh->prepare("INSERT INTO works(name,link,overview,position,status) VALUES (:name,:link,:overview,:position,:status)");

		$statement->execute(array(
		    "name" => $_POST["name"],
		    "link" => $_POST["link"],
		    "overview" => $_POST["overview"],
		    "position" => $_POST["position"],
		    "status" => $_POST["status"]
		));
		// if($result==true){
		// 	header("Location:".BASEURL."index.php");
		// 	exit();
		// }else{
		// 	$error="Error saving data,please try again";
		// }

	}catch(Exception $e){

	}
}

include("views/add.php");
?>