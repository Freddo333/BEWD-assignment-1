<?php include "templates/header.php"; ?>
 
<!DOCTYPE html>
<html lang="en" class="bg-secondary">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <div class="container-fluid bg-light">
        <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>.</h1>
    
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
		$amountOwed = 0;

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

        //if there are some results
        if ($result && $statement->rowCount() > 0) { 
		?>
            <h2>Your purchases are: </h2>

            <?php // This is a loop, which will loop through each result in the array
              foreach($result as $row) { ?>
			<p>
				Product name:
				<?php echo $row['productname']; ?><br>				
				Product cost: $
				<?php echo $row['cost']; ?><br> 		
				Amount paid: $
				<?php echo $row['paid']; ?><br> 		
				Date purchased:
				<?php echo substr($row['date'], 0, 10); ?><br> 
				<a href='update-item.php?id=<?php echo $row['id']; ?>'>Edit</a>
				<a href='delete.php?id=<?php echo $row['id'];?>'>Delete</a>
				<?php 	$amountOwed += $row['cost'];
						$amountOwed -= $row['paid']; ?>
			</p>
			<hr>
<?php		};
        };  
		
	if (isset($_POST['submit'])) {	
		require "config.php";
		
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			
			if ($_POST['cost'] ==""){
				$_POST['cost'] = '0';
			}
			if ($_POST['paid'] ==""){
				$_POST['paid'] = '0';
			}
			
			
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
			//header('Location:'.$_SERVER['PHP_SELF']);
			echo '<script> location.replace("welcome.php"); </script>';
					
		} catch (PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
?>
<h3>
New purchase
</h3>
<form method="post">
	<label for="productname">Product Name</label> 
	<input type="text" pattern="[A-Za-z0-9\ \-]{1,}" maxlength="32" name="productname" title="Alpha-numeric" id="productname"> 
	<label for="cost">Product cost $</label> 
	<input type="number" pattern=".{1,}" step=".01" name="cost" id="cost"> 
	<label for="paid">Amount paid $</label> 
	<input type="number" pattern=".{1,}" step=".01" name="paid" id="paid"> 
	<input type="submit" name="submit" value="Submit">
</form>

<hr>
<h2>
	You currently owe a total of $<?php echo $amountOwed ?>
</h2>

</div>
</body>
<?php include "templates/footer.php"; ?>
</html>
