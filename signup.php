<?php
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

  // Use password_hash() to hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if the username already exists using prepared statements , also insert table name here ---------
  $checkUsernameQuery = "SELECT * FROM --------- WHERE username=?";
  $stmt = mysqli_prepare($conn, $checkUsernameQuery);
  
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $checkUsernameResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
      echo "Username already exists. Please choose a different username.";
    } else {
      // Insert the new user using prepared statements with hashed password,  also insert table name here ---------
      $insertQuery = "INSERT INTO -------- (username, password) VALUES (?, ?)";
      $stmt = mysqli_prepare($conn, $insertQuery);

      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
        if (mysqli_stmt_execute($stmt)) {
          echo "Signup successful. You can now <a href='index.html'>login</a>." ;
        } else {
          echo "Error: " . mysqli_error($conn);
        }
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
    mysqli_stmt_close($stmt);
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
