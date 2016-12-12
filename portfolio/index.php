<?php
require_once('inc/bootstrap.php');
$sth = $dbh->prepare("SELECT * FROM works");
$sth->execute();
$works = $sth->fetchAll(PDO::FETCH_ASSOC);

include 'views/index.php';

?>