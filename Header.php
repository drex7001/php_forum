<nav>
  <div class="nav-container">
    <a href="HomePage.php">Home</a>
    <a href="Topics.php">Topics</a>
    <?php if ($cookieUser == "") { ?>
      <a href="SignUp.php">Sign Up</a>
      <a href="SignIn.php">Sign In</a>
    <?php } else { ?>
      <a href="LogOutUser.php">Sign Out</a>
      <a href="#"><?php echo $cookieUser; ?></a>
    <?php } ?>
  </div>
</nav>

