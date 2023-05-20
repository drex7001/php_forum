<?php
include('Functions.php');

// Check if the data from the POST was provided using 'isset', if not echo an error message (This does not need to be formated) (Note that only the username is passed this tme).


// Trim the input from the POST and store in a php variable
$topic = trim($_POST['topic']);
if (empty($topic)) {
	setCookieMessage('Please Enter Topic');
	header('Location: Topics.php');
	exit;
}
$dbh = connectToDatabase();

// Prepare, bind and execute the SQL command to check if topic already exists
$sql = "SELECT COUNT(*) FROM topic WHERE topic = ? COLLATE NOCASE";
$statement = $dbh->prepare($sql);
$statement->bindValue(1, $topic);
$statement->execute();

$rowCount = $statement->fetchColumn();

if ($rowCount > 0) {
    setCookieMessage('Topic already exists!');
    header('Location: Topics.php');
    exit;
}

// Else
else {

	// Get the id of the user using cookies
	$statement = $dbh->prepare('SELECT UserID FROM user WHERE username = ?');
	$statement->bindValue(1, getCookieUser());
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	// Set the datetime to Melbourne time using the following code:
	date_default_timezone_set("Australia/Melbourne");

	// Insert the topic into the database and then redirect back to Topics.php
	
	$sql = "INSERT INTO topic (UserID, datetime, topic) VALUES (?, ?, ?)";
	$statement = $dbh->prepare($sql);
	$statement->bindValue(1, $row['UserID']);
	$statement->bindValue(2, date("Y/m/d H:i:s"));
	$statement->bindValue(3, $topic);
	$statement->execute();
	setCookieMessage('The topice has been added successfully.');
	header('Location: Topics.php');
	exit;
}
