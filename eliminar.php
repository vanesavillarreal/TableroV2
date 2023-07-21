<?php
header('Content-Type: application/json');

// Database connection
require "conection.php";

// Check if the request is an AJAX request and the required data is provided
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_GET['id'])) {
  $id = $$_GET['id'];

  // Perform your desired action here (e.g., delete an item from the database)
  $sql = "delete from juridico where id='".$_GET["id"]."'";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  
  if ($result) {
    // Send a success response
    echo json_encode(['success' => true]);
  } else {
    // Send an error response
    echo json_encode(['success' => false]);
  }

  $stmt->close();
} else {
  // Send an error response
  echo json_encode(['success' => false]);
}

$mysqli->close();
?>
