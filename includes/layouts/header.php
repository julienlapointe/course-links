<?php
	// relative to files in "public" folder that include the files below (also in "public" folder)
    include_once("like_config.inc.php");
    include_once("slike/like_function.php");
?>

<?php 
	// $user_context is a variable used to display different layouts / features depending on the user type 
	// if $user_context doesn't hold a value, then set it to "guest" by default (safest; "guest" has the most restricted access to data and features)
	if (!isset($user_context)) 
	{
		// user types are: guest, standard (or normal / logged_in / authenticated?), admin
		$user_context = "guest";
	}

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<!-- conditionally add "Admin" to webpage title (visible in bookmarks on Chrome) if $user_context is "admin" -->
		<title>Course Links</title>
		<link href="stylesheets/styles.css" media="all" rel="stylesheet" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<!-- <script src="vote.js"></script> -->
	</head>

	<body>
		<div class="header">
			<div class="left-nav">
				<!-- conditionally add elements depending on $user_context -->
				<?php 

				// logo
				if ($user_context == "admin") 
				{ 
					echo "<h1><a href=\"dashboard.php\">Course Links</a></h1>"; 
				}
				else if ($user_context == "guest" || $user_context == "between")
				{
					echo "<h1><a href=\"index.php\">Course Links</a></h1>"; 
				} 
				?>

				<!-- search -->
				<form method='get' action='search.php'>
					<input type='text' name='query' placeholder="Search..." class='form-field'>
					<!-- <input type='submit' /> -->
				</form>
			</div>
			<!-- end of left nav -->
			<div class="right-nav">
				<?php

				// login / logout menu button
				if ($user_context == "admin") 
				{ 
					echo "<a class=\"login-logout-button\" href=\"login.php\">Logout</a>"; 
				}
				else if ($user_context =="guest")
				{
					echo "<a class=\"login-logout-button\" href=\"logout.php\">Login</a>"; 
				} 
				?>
			</div>
			<!-- end of right-nav -->
		</div> 
		<!-- end of header -->
<!-- open tags to be closed in footer.php -->