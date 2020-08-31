<!DOCTYPE html>

<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<?php include "banner.php"; ?>

  <div class="collapse navbar-collapse">
	<div class="navbar-nav">
        <a class="nav-link" href="welcome.php">Home</a>
        <a class="nav-link" href="reset-password.php">Change Password</a>
        <a class="nav-link" href="logout.php">Logout</a>
	</div>
  </div>
 </nav>
</body>