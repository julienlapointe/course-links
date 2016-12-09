<!-- are all these php tags needed? can I just put all require_onces into one? -->

<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $user_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php set_current_course_link(); ?>

<div id="main">
	<div id="navigation">
		<!-- "Back to Admin Dashboard" button -->
		<h2><a href="dashboard.php">&laquo; Back to menu</a></h2>
		<br>
		<!-- display menu in left sidebar -->
		<?php echo navigation($current_course, $user_context); ?>
		<br>
		<a href="create_course.php">+ Add a course</a>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<!-- if a course is selected, then display course details and list all links in that course with buttons to edit the course or add a new link to the course -->
		<?php if ($current_course) { ?>
		<h2><?php echo htmlentities($current_course["name"]); ?></h2>
			<br>
			Course name: <?php echo htmlentities($current_course["name"]); ?><br />
			Position: <?php echo $current_course["position"]; ?><br />
			Visible to guest users: <?php echo $current_course["visible"] == 1 ? 'Yes' : 'No'; ?><br />
			<!-- notes about urlencode() -->
			<!-- URLs can only be sent over the Internet using the ASCII character-set -->
			<!-- since URLs often contain characters outside the ASCII set, the URL has to be converted into a valid ASCII format -->
			<!-- URL encoding replaces unsafe ASCII characters with a "%" followed by two hexadecimal digits -->
			<!-- URLs cannot contain spaces; URL encoding normally replaces a space with a plus (+) sign or with %20 -->
			<!-- dynamically generate the link for editing the selected course (whatever it happens to be) -->
			<a href="edit_course.php?course=<?php echo urlencode($current_course["id"]); ?>">> Edit course</a>
			<!-- display all links in selected course -->
			<div>
				<br><br>
				<h2>Links for this course:</h2>
				<br>
				<ul>
				<?php 
					$link_set = find_links_for_course($current_course["id"], $user_context);
					// while($link = $course_links->fetch()) {
					foreach($link_set as $link) 
					{ 
						echo SmartLike($link["id"], "small_facebook"); ?>
						<a href="<?php echo htmlentities($link["url"]) ?>" target="_blank">
							<?php echo htmlentities($link["title"]); ?>
						</a>
						<?php
						if ($_SESSION["user_id"] == $link["user_id"])
						{
							$safe_link_id = urlencode($link["id"]);
							echo "<br><a href=\"edit_link.php?link={$safe_link_id}\">> Edit link</a><br><br>";
							echo "</li>";
						}
						else
						{
							echo "<br><br>";
						}
					}
				?>
				</ul>
				<a href="create_link.php?course=<?php echo urlencode($current_course["id"]); ?>">+ Add a new link to this course</a>
			</div>
		<!-- if a link is selected, then display link details with a button to edit the link -->
		<?php } else if ($current_link) { ?>
			<h2>Manage link</h2>
			Course name: <?php echo htmlentities($current_link["title"]); ?><br />
			Position: <?php echo $current_link["position"]; ?><br />
			Visible to guest users: <?php echo $current_link["visible"] == 1 ? 'Yes' : 'No'; ?><br />
			Title:<br />
			<div class="view-content">
				<?php echo htmlentities($current_link["title"]); ?>
			</div>
			<br />
	  <br />
	  <a href="edit_link.php?link=<?php echo urlencode($current_link['id']); ?>">Edit link</a>
			
		<?php } else { ?>
			Please select a course or a link.
		<?php }?>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>