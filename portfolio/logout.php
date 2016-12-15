<?php
require_once('inc/bootstrap.php');
unset($_SESSION["isUserLoggedIn"]);
header("location:".BASEURL."login.php");
exit();

?>