<?php include "templates/header.php"; ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <div class="container-fluid text-left text-md-left">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    
	<?php 
// include the config file that we created before
    require "config.php"; 
    
    // this is called a try/catch statement 
	try {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * FROM products WHERE username = '{$_SESSION["username"]}'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
		$maxId = 0;

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

        //if there are some results
        if ($result && $statement->rowCount() > 0) { 
		?>
            <h2>Results</h2>

            <?php // This is a loop, which will loop through each result in the array
              foreach($result as $row) { ?>
			<p>
				Product name:
				<?php echo $row['productname']; ?><br>				
				Product cost:
				<?php echo $row['cost']; ?><br> 		
				Amount paid:
				<?php echo $row['paid']; ?><br> 		
				Date purchased:
				<?php echo $row['date']; ?><br> 
				<a href='update-item.php?id=<?php echo $row['id']; ?>'>Edit</a>
				<?php $maxId = $row['id'];?>
			</p>
			<hr>
<?php		};
        };  
		
	if (isset($_POST['submit'])) {	
		require "config.php";
		
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			
			$new_products = array( 
				"username"    => $_SESSION["username"], 
				"productname"    => $_POST['productname'], 
				"cost"     => $_POST['cost'],
				"paid"      => $_POST['paid'],
				"date"      => date("Y/m/d"), 
			);
			
			$sql = "INSERT INTO products (
				username,
				productname,
				cost,
				paid,
				date
			) VALUES (
				:username,
				:productname,
				:cost,
				:paid,
				:date
			)";  
			
			$statement = $connection->prepare($sql);
			$statement->execute($new_products);
			unset($_POST);
			header('Location:'.$_SERVER['PHP_SELF']);
					
		} catch (PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
?>
<form method="post">
	<label for="productname">Product Name</label> 
	<input type="text" name="productname" id="productname"> 
	<label for="cost">Product cost</label> 
	<input type="text" name="cost" id="cost"> 
	<label for="paid">Amount paid</label> 
	<input type="text" name="paid" id="paid"> 
	<input type="submit" name="submit" value="Submit">
</form>
</div>
</body>
</html>

<?php include "templates/footer.php"; ?>