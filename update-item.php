<?php include "templates/header.php"; ?>
<div class="container-fluid bg-light">
<title>Edit</title>
<h1>Edit</h1>
<?php 

    // include the config file that we created last week
    require "config.php";
	require "common.php";

	// run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
				
				if ($_POST['cost'] ==""){
					$_POST['cost'] = '0';
					}
				if ($_POST['paid'] ==""){
					$_POST['paid'] = '0';
				}
			    //grab elements from form and set as varaible
				$product = array( 
				"id"    		=> $_POST['id'], 
				"username"    	=> $_SESSION['username'], 
				"productname"   => $_POST['productname'], 
				"cost"     		=> $_POST['cost'],
				"paid"      	=> $_POST['paid'],
				"date"      	=> $_POST['date'], 
			);
			
				// create SQL statement
				$sql = "UPDATE `products` 
						SET id = :id, 
							username = :username, 
							productname = :productname, 
							cost = :cost, 
							paid = :paid, 
							date = :date 
						WHERE id = :id AND username = :username";
			
				//prepare sql statement
				$statement = $connection->prepare($sql);
			
				//execute sql statement
				$statement->execute($product);
            
            } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
		
    }

    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        // quickly show the id on the page
        //echo $_GET['id'];
		
		 try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM products WHERE id = :id AND username = '{$_SESSION['username']}'";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
			
            
            // attach the sql statement to the new product variable so we can access it in the form
            $productIn = $statement->fetch(PDO::FETCH_ASSOC);
            
			
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    }
?>

<?php if (isset($_POST['submit']) && $statement) {
//header("location: welcome.php");
echo '<script> location.replace("welcome.php"); </script>';
}?>

<form method="post">
    
    <input type="hidden" name="id" id="id" readonly value="<?php echo escape($productIn['id']); ?>" >
    <label for="productname">productname</label>
    <input type="text" pattern="[A-Za-z0-9\ \-]{1,}" title="Alpha-numeric" maxlength="32" name="productname" id="productname" value="<?php echo escape($productIn['productname']); ?>">
    <label for="cost">cost</label>
    <input type="text" step=".01" name="cost" id="cost" value="<?php echo escape($productIn['cost']); ?>">
    <label for="paid">paid</label>
    <input type="text" step=".01" name="paid" id="paid" value="<?php echo escape($productIn['paid']); ?>">
    <input type="hidden" name="date" id="date" readonly value="<?php echo escape($productIn['date']); ?>">
    <input type="submit" name="submit" value="Save">

</form>

</div>
<?php include "templates/footer.php"; ?>