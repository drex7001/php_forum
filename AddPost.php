<?php // <--- do NOT put anything before this PHP tag

// this php file will have no HTML
include('Functions.php');
$Post = trim($_POST['Post']);
$Topic = trim($_GET['Topic']);

$dbh = connectToDatabase();
$statement2 = $dbh->prepare('INSERT INTO Post (UserID, Post, DateTime, TopicID) VALUES (?,?, ?, ?); ');
date_default_timezone_set("Australia/Melbourne");
$statement2->bindValue(1,1);
$statement2->bindValue(2,$Post);
$statement2->bindValue(3, date("Y/m/d H:i:s"));
$statement2->bindValue(4,10);
$statement2->execute();
redirect("Forum.php?topic=$Topic");
