<?php // <--- do NOT put anything before this PHP tag
	include('Functions.php');
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
		<div class="row", id="header">
			<?php @include('Header.php'); ?>
		</div>
		<div class="row", id="nav">  
			
		</div>
		<div class="row", id="content">
			Home Page
		</div>
		<div class="row", id="footer">
			
		</div>
	</div>
</body>
</html>