<?php
require_once('inc/bootstrap.php');

if($_SESSION['isUserLoggedIn']!==true){
	header("location:".BASEURL."login.php");
	exit();
}

try{
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->beginTransaction();

	$id= $_GET["id"];
	$stmt = $dbh->prepare("DELETE FROM works WHERE id = ?");
	$stmt->execute(array($id));

	$stmt = $dbh->prepare("DELETE FROM work_images WHERE work_id = ?");
	$stmt->execute(array($id));

	$dbh->commit();
	header("Location:".BASEURL."index.php");
	exit();
}catch(Exception $e){
	$dbh->rollBack();
  	echo "Failed: " . $e->getMessage();
}