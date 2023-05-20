<?php
include('Functions.php');

// Function to set the error message and redirect back to the login page
function redirectWithError()
{
	header('Location: SignIn.php');
	exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get the username from the form
	$username = trim($_POST['UserName']);
	// Validate the username (you can customize this validation according to your requirements)
	if (empty($username)) {
		setCookieMessage('Please enter username');
		redirectWithError();
	}

	// Perform your database query to validate the username (assuming the table name is 'users')
	// Replace 'your_db_file.sqlite' with the actual path to your SQLite database file
	$db = connectToDatabase();

	if (!$db) {
		redirectWithError();
	}

	$query = "SELECT COUNT(*) as count FROM `user` WHERE `username` = :username";
	$stmt = $db->prepare($query);
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$row = $stmt->fetch();

	$count = $row['count'];
	if ($count > 0) {
		setCookieUser($username);
		header('Location: HomePage.php');
		exit();
	} else {
		setCookieMessage('User name not found');
		redirectWithError();
	}
}
