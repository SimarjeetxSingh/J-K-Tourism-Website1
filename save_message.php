<?php
// Replace the database connection details with your own
$servername = "";
$username = "";
$password = "";
$dbname = "";

$response = ""; // Initialize 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $message = $_POST["message"];


  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//insert message , also insert table name here-------
  $stmt = $conn->prepare("INSERT INTO -------- (name, message) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $message);

  if ($stmt->execute()) {
    $response = "Message sent and saved successfully.";
  } else {
    // Failed
    $response = "Failed to send the message. Please try again.";
  }

  // Close the connection
  $stmt->close();
  $conn->close();
}
// json direct response same page pe alert krne ke liye
echo json_encode(array("response" => $response));
?>


