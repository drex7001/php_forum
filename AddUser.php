<?php // <--- do NOT put anything before this PHP tag

// this php file will have no HTML

include('Functions.php');

// Sanitize the form data to prevent SQL injection
$username = makeOutputSafe($_POST['username']);
$firstName = makeOutputSafe($_POST['firstName']);
$surname = makeOutputSafe($_POST['surname']);
$short_tag = makeOutputSafe($_POST['short_tag']);

// Connect to the SQLite database
$db = connectToDatabase();

// Prepare the SQL statement to insert the user into the database
$stmt = $db->prepare('INSERT INTO User (UserName, firstName, SurName, Tag) VALUES (:username, :firstName, :surname, :short_tag)');

$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
$stmt->bindValue(':surname', $surname, SQLITE3_TEXT);
$stmt->bindValue(':short_tag', $short_tag, SQLITE3_TEXT);

// Execute the prepared statement
$result = $stmt->execute();

// Check if the insertion was successful
if ($result) {
  	// Redirect to a success page
  	session_start();
	$message = "User has been added successfully.";
	$messageClass = "success";
	// header("Location: SignUp.php");
} else {
//Redirect to an error page
//header("Location: error.php");
session_start();
	$message = "An error occurred while adding the user. Please try again.";
  	$messageClass = "error";
}
