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
				<?php
				// Display  message if set
				$message = getCookieMessage();
				if($message){
					$messageClass = strpos($message, 'successfully') !== false ? 'success-message' : 'error-message';
					echo '<div class="'.$messageClass.'">' . getCookieMessage() . '</div>';
				}
				?>
				<form action="LogInUser.php" method="post">
					<label for="UserName">Username:</label>
					<input type="text" id="UserName" name="UserName">
					<input type="submit" value="Sign In">
				</form>
			</div>
		</div>
		<div class="row" , id="footer">
		<?php @include('Footer.php'); ?>
		</div>
	</div>
</body>

</html>