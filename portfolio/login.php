<?php 
require_once('inc/bootstrap.php');

// echo Password::hash("123456");

if(!empty($_POST['email']) && !empty($_POST['password'])){
	$statement = $dbh->prepare("SELECT password FROM admins where email=?");

	$statement->execute(array($_POST['email']));
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	if($user!=false){
		if(Password::verify($_POST["password"],$user["password"])=== true){
			$_SESSION['isUserLoggedIn']=true;
			header("location:".BASEURL."index.php");
			exit();
		}

	}	
	$error ="Error email/password combination!";

}




include 'views/login.php';

?>