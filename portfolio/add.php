<?php
require_once('inc/bootstrap.php');
if($_SESSION['isUserLoggedIn']!==true){
	header("location:".BASEURL."login.php");
	exit();
}
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
	try{

		if(!empty($_FILES["coverimage"])){
			$check = getimagesize($_FILES["coverimage"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		    $target_file = BASEDIR."/assets/ugc/".$_FILES["coverimage"]["name"];

		    if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
		    if ($uploadOk == 0) {
		        echo "Sorry, your file was not uploaded.";

		    } else {
		        if (move_uploaded_file($_FILES["coverimage"]["tmp_name"], $target_file)) {
		            echo "The file ". basename( $_FILES["coverimage"]["name"]). " has been uploaded.";
		        } else {
		            echo "Sorry, there was an error uploading your file.";
		        }
		    }
		}

		try{
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbh->beginTransaction();

			$statement = $dbh->prepare("INSERT INTO works(name,link,overview,position,status,coverimage) VALUES (:name,:link,:overview,:position,:status,:coverimage)");

			$result=$statement->execute(array(
			    "name" => $_POST["name"],
			    "link" => $_POST["link"],
			    "overview" => $_POST["overview"],
			    "position" => $_POST["position"],
			    "status" => $_POST["status"],
			    "coverimage" => basename($target_file)
			));
			$workId = $dbh->lastInsertId();

			$moreImages=array();

			if(!empty($_FILES["moreimage"])){
				foreach ($_FILES["moreimage"]["name"] as $key => $name){
					$target_file = BASEDIR."/assets/ugc/".$name;
					if(move_uploaded_file($_FILES["moreimage"]["tmp_name"][$key], $target_file)){
						$moreImages[] = basename($target_file);
					}

				}
			}
			if(!empty($moreImages)){

				$statement = $dbh->prepare("INSERT INTO work_images(work_id,image) VALUES (:work_id,:image)");
				foreach($moreImages as $image){
					$statement->execute(array(
						"work_id" => $workId,
						"image"=>$image
					));
				}

			}
			$dbh->commit();
		}catch(Exception $e){
			$dbh->rollBack();
  			echo "Failed: " . $e->getMessage();
		}

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