<?php
session_start();
ini_set('display_errors',1);
try {
    $dbh = new PDO('mysql:host=localhost;dbname=we500_demo', 'root', 'qwe!@#');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
define("BASEURL","/portfolio/");
define("BASEDIR",dirname(dirname(__FILE__)));
require_once 'inc/password.php';
?>