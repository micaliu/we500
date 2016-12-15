<?php
require_once('inc/bootstrap.php');

if($_SESSION['isUserLoggedIn']!==true){
	header("location:".BASEURL."login.php");
	exit();
}
$sth = $dbh->prepare("SELECT * FROM works");
$sth->execute();
$works = $sth->fetchAll(PDO::FETCH_ASSOC);

include 'views/index.php';

?>