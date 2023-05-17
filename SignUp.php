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
				<form action="register.php" method="post">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" required>
					<label for="firstName">First Name:</label>
					<input type="text" id="firstName" name="firstName" required>
					<label for="surname">Surname:</label>
					<input type="text" id="surname" name="surname" required>
					<label for="shortTag">Short Tag:</label>
					<input type="text" id="shortTag" name="shortTag" required>
					<input type="submit" value="Sign Up">
				</form>
			</div>
		</div>
		<div class="row" , id="footer">

		</div>
	</div>
</body>

</html>