<?php
session_start();
include('Functions.php');


// Function to set the error message and redirect back to the login page
function redirectWithError($error)
{
	$_SESSION['error'] = $error;
	header('Location: SignIn.php');
	exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get the username from the form
	$username = $_POST['UserName'];
	var_dump($username);
	// Validate the username (you can customize this validation according to your requirements)
	if (empty($username)) {
		redirectWithError('Please enter a username.');
	}

	// Perform your database query to validate the username (assuming the table name is 'users')
	// Replace 'your_db_file.sqlite' with the actual path to your SQLite database file
	$db = connectToDatabase();

	if (!$db) {
		redirectWithError('Failed to connect to the database.');
	}

	$query = "SELECT COUNT(*) as count FROM `user` WHERE `username` = :username";
	$stmt = $db->prepare($query);
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$row = $stmt->fetch();

	$count = $row['count'];
	if ($count > 0) {
		// Username is valid, create cookies and redirect to the home page
		setcookie('username', $username, time() + 3600, '/');
		$_SESSION['username'] = $username;
		header('Location: HomePage.php');
		exit();
	} else {
		// Username is invalid, display error message
		redirectWithError('Invalid username.');
	}
}
