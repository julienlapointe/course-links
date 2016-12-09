<!-- PHP code invisible to user -->
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
  		<!-- if $current_link holds a value, output it to the user -->
		<?php if (isset($_GET['query'])) 
		{ 
			$query = "%".$_GET['query']."%";
			$result_set = search_results_for($query);
			echo "<pre>";
				// print_r($result_set);
			echo "</pre>";
			foreach ($result_set as $row)
			{ 
				// if this record is a course, then...
				if (isset($row["name"]))
				{ ?>
				<a href="<?php echo htmlentities($row["name"]) ?>">
					<?php echo htmlentities($row["name"]); ?>
				</a>
				[course]
				<br><br>
			<?php }
				// if this record is a link, then...
				else if (isset($row["title"]))
				{ ?>
				<a href="<?php echo htmlentities($row["title"]) ?>" target="_blank">
					<?php echo htmlentities($row["title"]); ?>
				</a>
				[link]
				<br><br>
			<?php }
				// if this record is a user, then...
				else if (isset($row["username"]))
				{ ?>
				<a href="<?php echo htmlentities($row["username"]) ?>">
					<?php echo htmlentities($row["username"]); ?>
				</a>
				[user]
				<br><br>
			<?php }
			// need to account for search_results_for($query) returning no results
			} 
		}
		else 
		{ 
			echo "No results found.";
		} ?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>