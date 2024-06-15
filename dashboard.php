<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit(); // Make sure to exit to prevent further script execution
}

elseif (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
} else {
    echo 'Guest'; // Default if not logged in
}
 
?>