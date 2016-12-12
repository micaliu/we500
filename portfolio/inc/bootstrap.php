<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=we500_demo', 'root', 'qwe!@#');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
define("BASEURL","/portfolio/");
?>