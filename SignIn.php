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
			<div class="sign_in_container">
				<h1>Sign In</h1>
				<form action="login.php" method="post">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" required>
					<input type="submit" value="Sign In">
				</form>
			</div>
		</div>
		<div class="row" , id="footer">

		</div>
	</div>
</body>

</html>


<!-- <h1>Sign In</h1>
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $_POST['username'];
				if ($username == '') {
					echo "<p>Please enter your username.</p>";
				} else {
					// Check if the username exists in the database or in the cookies
					// If it does, set the cookie and redirect to the home page
					// If it doesn't, display an error message
					// Note: This code assumes that you have a database or cookie-based user authentication system in place
					if (checkUserExists($username)) {
						setcookie("CookieUser", $username, time() + (86400 * 30), "/"); // Set a cookie for 30 days
						header('Location: home.php');
						exit();
					} else {
						echo "<p>Invalid username. Please try again.</p>";
					}
				}
			}
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username">
				<br>
				<input type="submit" value="Sign In">
			</form> -->