<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
// $cookieUser = getCookieUser();
?>
<!DOCTYPE html>
<html>

<head>
	<title> </title>
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
	<div class="container">
		<div class="row" , id="header">
			<?php @include('Header.php'); ?>
		</div>

		<div class="row" , id="nav">

		</div>

		<div class="row" , id="content">
			<div class="sign_up_container">
				<h1>Sign Up</h1>

				<?php
				// Display  message if set
				$message = getCookieMessage();
				if($message){
					$messageClass = strpos($message, 'successfully') !== false ? 'success-message' : 'error-message';
					echo '<div class="'.$messageClass.'">' . getCookieMessage() . '</div>';
				}
				?>

				<form action="AddUser.php" method="post">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username">
					<label for="firstName">First Name:</label>
					<input type="text" id="firstName" name="firstName">
					<label for="surname">Surname:</label>
					<input type="text" id="surname" name="surname">
					<label for="shortTag">Short Tag:</label>
					<input type="text" id="short_tag" name="short_tag">
					<input type="submit" value="Sign Up">
				</form>
			</div>
		</div>
		<div class="row" , id="footer">
			<?php @include('Footer.php'); ?>
		</div>
	</div>
</body>

</html>