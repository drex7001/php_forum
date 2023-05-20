<?php // <--- do NOT put anything before this PHP tag

// this php file will have no HTML
include('Functions.php');

// Sanitize the form data to prevent SQL injection	
$topic = makeOutputSafe($_POST['topic']);


$currentDateTime = date('Y-m-d H:i:s');

// Connect to the SQLite database
$db = connectToDatabase();

// Prepare the SQL statement
$stmt = $db->prepare("INSERT INTO Topic (DateTime, Topic) VALUES (:currentDateTime, :topic)");

// Bind the parameters
$stmt->bindValue(":currentDateTime", $currentDateTime, SQLITE3_TEXT);
$stmt->bindValue(":topic", $topic, SQLITE3_TEXT);
// Execute the statement
$stmt->execute();

// Close the database connection
$db->close();

// Redirect to a success page or perform any other desired actions
header("Location: success.php");
exit();
?>