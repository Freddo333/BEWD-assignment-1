<?php

	$host       = "localhost";
	$username   = "uxcw645uqx93k";
	$password   = "n5sae7xkgq8h";
	$dbname     = "dbhn3jvenbqam4"; 
	$dsn        = "mysql:host=$host;dbname=$dbname"; 
	$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
			  
	try{
		$pdo_connection = new PDO($dsn, $username, $password, $options);
	} catch(PDOException $e){
		die("ERROR: Could not connect. " . $e->getMessage());
	}
?>
