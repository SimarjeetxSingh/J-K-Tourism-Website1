<?php
session_start();

// Replace with your own database credentials
$host = "";
$db_username = "";
$db_password = "";
$db_name = "";

$conn = mysqli_connect($host, $db_username, $db_password, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Use prepared statement to avoid SQL injection  - also insert table name here -------
  $stmt = mysqli_prepare($conn, "SELECT * FROM ------ WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Verify the hashed password
    if (password_verify($password, $user['password'])) {
      $_SESSION["username"] = $username;
      header("Location: dashboard.html"); // Redirect to the dashboard page after successful login
    } else {
      echo "Invalid credentials. Please try again.";
    }
  }
 else {
    echo "Invalid credentials. Please try again.";
  }
  mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
