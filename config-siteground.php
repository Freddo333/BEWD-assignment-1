<?php

	$host       = "localhost";
	$username   = "uhez2hnkb3zt8";
	$password   = "wmu4befgcbu9";
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
