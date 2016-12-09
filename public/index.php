<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<!-- $user_context is set to "guest" by default for security (this user role has access to the least data / features) -->
<!-- $user_context is used for conditionally showing elements depending on the user's role -->
<!-- removed setting of $user_context to "guest" here -->
<?php include("../includes/layouts/header.php"); ?>
<!-- sets values for $current_link and $current_course -->
<!-- $public parameter is set to TRUE with TRUE argument passed in -->
<?php set_current_course_link(true); ?>

<div id="main">
  <div id="navigation">
		<?php echo navigation($current_course, $user_context); ?>
  </div>
  <div id="page">
  		<!-- if $current_link holds a value, output it to the user -->
		<?php if ($current_course) { 
			$link_set = find_links_for_course($current_course["id"], $user_context);
			foreach ($link_set as $link)
			{ 
				echo SmartLike($link["id"], "small_facebook");
				?>
				<a href="<?php echo htmlentities($link["url"]) ?>" target="_blank">
					<?php echo htmlentities($link["title"]); ?>
				</a>
				<br><br>
			<?php } ?>
		<!-- otherwise, display instructions -->
		<?php 
		} 
		else 
		{ 
			echo "Select a course to see its links.";
		} ?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>