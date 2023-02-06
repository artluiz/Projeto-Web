<?php
try {
	$dbh = new PDO('mysql:host=localhost;dbname=rede_social;charset=utf8mb4;user=dev;password=123456');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	print "Erro!: " . $e->getMessage() . "<br/>";
	$dbh = null;
	die();
}
?>