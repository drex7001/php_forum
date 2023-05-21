<?php // <--- do NOT put anything before this PHP tag

// this php file will have no HTML
include('Functions.php');
$Post = trim($_POST['Post']);
$Topic = trim($_GET['Topic']);

date_default_timezone_set("Australia/Melbourne");
$dbh = connectToDatabase();

$statement = $dbh->prepare('SELECT UserID FROM user WHERE username = ?');
$statement->bindValue(1, getCookieUser());
$statement->execute();
$row1 = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $dbh->prepare('SELECT TopicID FROM Topic WHERE Topic = ?');
$statement->bindValue(1, $Topic);
$statement->execute();
$row2 = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $dbh->prepare('INSERT INTO Post (UserID, Post, DateTime, TopicID) VALUES (?,?, ?, ?); ');
$statement->bindValue(1,$row1['UserID']);
$statement->bindValue(2,$Post);
$statement->bindValue(3, date("Y/m/d H:i:s"));
$statement->bindValue(4,$row2['TopicID']);
$statement->execute();
// redirect("Forum.php?topic=$Topic");
redirect("Forum.php");
