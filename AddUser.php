<?php // <--- do NOT put anything before this PHP tag

// this php file will have no HTML

include('Functions.php');

// Function to check if a field is empty or not
function isEmptyField($field) {
    return empty($field);
}

// Function to check if a username already exists in the database
function isExistingUsername($username) {
    // Connect to the SQLite database
    $db = connectToDatabase();

    // Prepare the SQL statement to check for the username
    $stmt = $db->prepare('SELECT COUNT(*) FROM User WHERE UserName = :username');
    $stmt->bindValue(':username', $username);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch the result
    $count = $stmt->fetchColumn();

    return $count > 0;
}

// Sanitize the form data to prevent SQL injection
$username = makeOutputSafe(trim($_POST['username']));
$firstName = makeOutputSafe(trim($_POST['firstName']));
$surname = makeOutputSafe(trim($_POST['surname']));
$short_tag = makeOutputSafe(trim($_POST['short_tag']));

// Check if any field is empty
if (isEmptyField($username) || isEmptyField($firstName) || isEmptyField($surname) || isEmptyField($short_tag)) {
    setCookieMessage('Please fill in all the fields');
    setCookie('messageClass', 'error-message');
    header("Location: SignUp.php");
    exit; // Stop further execution
}

// Check if the username already exists
if (isExistingUsername($username)) {
    setCookieMessage('The Username ' .$username. ' already taken');
    setCookie('messageClass', 'error-message');
    header("Location: SignUp.php");
    exit; // Stop further execution
}

// Connect to the SQLite database
$db = connectToDatabase();

// Prepare the SQL statement to insert the user into the database
$stmt = $db->prepare('INSERT INTO User (UserName, firstName, SurName, Tag) VALUES (:username, :firstName, :surname, :short_tag)');

$stmt->bindValue(':username', $username);
$stmt->bindValue(':firstName', $firstName);
$stmt->bindValue(':surname', $surname);
$stmt->bindValue(':short_tag', $short_tag);

// Execute the prepared statement
$result = $stmt->execute();

// Check if the insertion was successful
if ($result) {
    setCookieMessage('The username ' .$username. ' has been added successfully. Please Sign into posting.');
    setCookie('messageClass', 'success-message');
	header("Location: HomePage.php");
} else {
    setCookieMessage('Error');
    setCookie('messageClass', 'error-message');
    header("Location: SignUp.php");
}
