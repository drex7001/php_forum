<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();
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
    // Check if a message is set in the session
    session_start();
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      $messageClass = $_SESSION['messageClass'];
      // Display the message
      echo '<div class="' . $messageClass . '">' . $message . '</div>';
      // Clear the session variables
      unset($_SESSION['message']);
      unset($_SESSION['messageClass']);
    }
    ?>
				<form action="AddUser.php" method="post">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" required>
					<label for="firstName">First Name:</label>
					<input type="text" id="firstName" name="firstName" required>
					<label for="surname">Surname:</label>
					<input type="text" id="surname" name="surname" required>
					<label for="shortTag">Short Tag:</label>
					<input type="text" id="short_tag" name="short_tag" required>
					<input type="submit" value="Sign Up">
				</form>
			</div>
		</div>
		<div class="row" , id="footer">

		</div>
	</div>
</body>

</html>