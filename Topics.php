<?php // <--- do NOT put anything before this PHP tag
include 'Functions.php';
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();


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
			<?php @include 'Header.php'; ?>
		</div>
		<div class="row" , id="nav">

		</div>
		<div class="row" , id="content">
			<div>
				<?php

				// Get all of the topics from the database
				$dbh = connectToDatabase();
				$sql = 'SELECT * FROM topic';
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
				$sql = "SELECT * FROM Topic INNER JOIN User ON Topic.UserID = User.UserID ORDER BY Topic.TopicID DESC LIMIT 10 OFFSET $offset";
				$statement = $dbh->prepare($sql);
				$statement->execute();
				$currentTopics = $statement->fetchAll(PDO::FETCH_ASSOC);

				// Create the table
				echo '<div class="table-container">';
				echo '<table class="my-table">';
				echo '<tr><th>Topic</th><th>Created by</th><th>Datetime</th></tr>';
				foreach ($currentTopics as $topic) {
					echo '
						<tr>
							<td><a href="Forum.php?Topic=' . $topic['Topic'] . '">' . $topic['Topic'] . '</a></td>
							<td>' . $topic['FirstName'] . ' ' . $topic['SurName'] . '</td>
							<td>' . $topic['DateTime'] . '</td>
						</tr>
						';
				}

				echo '</table>';
				echo '</div>';

				// Create the pagination links
				echo '<div class="pagination-links">';
				for ($i = 1; $i <= ceil($totalTopics / 10); $i++) {
					echo "<a href='?page=$i'>$i</a> ";
				}
				echo '</div>';

				?>
				<?php
				if (getCookieUser()) {
					echo '<div class="sign_in_container">
                        <h1>Create new topic</h1>
                        <form action="AddTopic.php" method="post">';

					// Display message if set
					$message = getCookieMessage();
					if ($message) {
						$messageClass = strpos($message, 'successfully') !== false ? 'success-message' : 'error-message';
						echo '<div class="' . $messageClass . '">' . getCookieMessage() . '</div>';
					}

					echo '
						<label for="topic">Topic:</label>
                		<input type="text" id="topic" name="topic">
                		<input type="submit" value="Submit">
                		</form>
                		</div>';
				} else {
					echo '<p>Please sign in to create a new topic.</p>';
				}
				?>

			</div>
			<div class="row" , id="footer">
				<?php @include 'Footer.php'; ?>
			</div>
		</div>
</body>

</html>