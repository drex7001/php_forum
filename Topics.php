<?php // <--- do NOT put anything before this PHP tag
	include('Functions.php');
	$cookieMessage = getCookieMessage();
	$cookieUser = getCookieUser();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css"> 
	<meta charset="UTF-8">		<!-- For emojis -->
</head>
<body>
	<div class="container">
		<div class="row", id="header">
		<?php @include('Header.php'); ?>
		</div>
		<div class="row", id="nav">  
			
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
		<div class="row", id="footer">	
		<?php @include('Footer.php'); ?>	
		</div>
	</div>
</body>
</html>