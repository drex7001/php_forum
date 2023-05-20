<?php
include('Functions.php');

// Check if the data from the POST was provided using 'isset', if not echo an error message (This does not need to be formated) (Note that only the username is passed this tme).
if (!isset($_POST['topic'])) {
	echo "Error: No topic was provided.";
	exit;
}

// Trim the input from the POST and store in a php variable
$topic = trim($_POST['topic']);
$dbh = connectToDatabase();


// Prepare, bind and execute the SQL command to check if topic already exists
$sql = "SELECT * FROM topic WHERE topic = ? COLLATE NOCASE";
$statement = $dbh->prepare($sql);
$statement->bindValue(1, $topic);
$statement->execute();

// If the topic already exists then set the cookie message to indicate that the topic already exists and redirect to the Topics.php page
if ($statement->rowCount() > 0) {
	setcookie('topic_already_exists', 'true', time() + (3600 * 24));
	header('Location: Topics.php');
	exit;
}

// Else
else {

	// Get the id of the user using cookies
	$statement = $dbh->prepare('SELECT UserID FROM user WHERE username = ?');
	$statement->bindValue(1, 35);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	$userID = 35;

	// Set the datetime to Melbourne time using the following code:
	date_default_timezone_set("Australia/Melbourne");

	// Insert the topic into the database and then redirect back to Topics.php
	$sql = "INSERT INTO topic (UserID, datetime, topic) VALUES (?, ?, ?)";
	$statement = $dbh->prepare($sql);
	$statement->bindValue(1, $userID);
	$statement->bindValue(2, date("Y/m/d H:i:s"));
	$statement->bindValue(3, $topic);
	$statement->execute();

	header('Location: Topics.php');
	exit;
}
