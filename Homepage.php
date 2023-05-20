<?php // <--- do NOT put anything before this PHP tag
include 'Functions.php';
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
	<div class="container">
		<div class="row" , id="header">
			<?php @include 'Header.php'; ?>
		</div>
		<div class="row" , id="nav">

		</div>
		<div class="row" , id="content">
			<?php
			// Display  message if set
			$message = getCookieMessage();
			if ($message) {
				$messageClass = strpos($message, 'added') !== false ? 'success-message' : 'error-message';
				echo '<div class="' . $messageClass . '">' . getCookieMessage() . '</div>';
			}
			?>

			<div class="welcome-section">
				<h1>Welcome to our Website!</h1>
				<p>We are thrilled to have you here.</p>
				<img src="https://images.unsplash.com/photo-1560421683-6856ea585c78?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1174&q=80" alt="Welcome Image">
			</div>

			<div class="image-grid-section">
				<div class="image-grid-item">
					<img src="https://images.unsplash.com/photo-1516146544193-b54a65682f16?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Image 1">
				</div>
				<div class="image-grid-item">
					<img src="https://images.unsplash.com/photo-1598160882026-6e61d16dc8c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1171&q=80" alt="Image 2">
				</div>
				<div class="image-grid-item">
					<img src="https://images.unsplash.com/photo-1461344577544-4e5dc9487184?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Image 3">
				</div>
				<div class="image-grid-item">
					<img src="https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" alt="Image 4">
				</div>
			</div>
		</div>
		<div class="row" , id="footer">
			<?php @include 'Footer.php'; ?>
		</div>
	</div>
</body>

</html>