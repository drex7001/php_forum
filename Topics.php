<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();

// if (!isset($_SESSION['user_id'])) {
// 	header('Location: index.php');
// }

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<meta charset="UTF-8"> <!-- For emojis -->
</head>

<body>
	<div class="container">
		<div class="row" , id="header">
			<?php @include('Header.php'); ?>
		</div>
		<div class="row" , id="nav">

		</div>
		<div class="row" , id="content">
			<div class="sign_in_container">
				<h1>Create new topic</h1>
				<form action="AddTopic.php" method="post">
					<label for="topic">Topic:</label>
					<input type="text" id="topic" name="topic" required>
					<input type="submit" value="Submit">
				</form>
			</div>
			<div>
				<!-- <?php
				if (isset($_COOKIE['topic_already_exists']) && $_COOKIE['topic_already_exists'] == 'true') {
					echo "The topic you entered already exists.";
				} else {

					// Get all of the topics from the database
					$dbh = connectToDatabase();
					$sql = "SELECT * FROM topic";
					$statement = $dbh->prepare($sql);
					$statement->execute();
					$topics = $statement->fetchAll(PDO::FETCH_ASSOC);

					// Loop through the topics and display them
					echo "<table>";
					echo "<tr><th>Topic</th><th>User ID</th><th>Datetime</th></tr>";
					foreach ($topics as $topic) {
						echo "<tr><td>" . $topic['Topic'] . "</td><td>" . $topic['UserID'] . "</td><td>" . $topic['DateTime'] . "</td></tr>";
					}
					echo "</table>";
				}
				?> -->

				<?php
				if (isset($_COOKIE['topic_already_exists']) && $_COOKIE['topic_already_exists'] == 'true') {
					echo "The topic you entered already exists.";
				} else {

					// Get all of the topics from the database
					$dbh = connectToDatabase();
					$sql = "SELECT * FROM topic";
					$statement = $dbh->prepare($sql);
					$statement->execute();
					$topics = $statement->fetchAll(PDO::FETCH_ASSOC);

					// Get the total number of topics
					$totalTopics = count($topics);

					// Set the default page number to 1
					$pageNumber = 1;

					// Get the page number from the URL
					if (isset($_GET['page'])) {
						$pageNumber = $_GET['page'];
					}

					// Calculate the offset
					$offset = ($pageNumber - 1) * 10;

					// Get the topics for the current page
					$sql = "SELECT * FROM topic LIMIT 10 OFFSET $offset";
					$statement = $dbh->prepare($sql);
					$statement->execute();
					$currentTopics = $statement->fetchAll(PDO::FETCH_ASSOC);

					// Create the table
					echo "<table>";
					echo "<tr><th>Topic</th><th>User ID</th><th>Datetime</th></tr>";
					foreach ($currentTopics as $topic) {
						echo "<tr><td>" . $topic['Topic'] . "</td><td>" . $topic['UserID'] . "</td><td>" . $topic['DateTime'] . "</td></tr>";
					}
					echo "</table>";

					// Create the pagination links
					for ($i = 1; $i <= ceil($totalTopics / 10); $i++) {
						echo "<a href='?page=$i'>$i</a> ";
					}
				}
				?>

			</div>
			<div class="row" , id="footer">
				<?php @include('Footer.php'); ?>
			</div>
		</div>
</body>

</html>