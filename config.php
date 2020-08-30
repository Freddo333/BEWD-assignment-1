<?php

	$host       = "localhost";
	$username   = "root";
	$password   = "root";
	$dbname     = "kyle_art"; 
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
