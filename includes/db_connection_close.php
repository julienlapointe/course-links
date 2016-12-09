<?php
	// step 5 of 5: close database connection
	// if $db holds a value, close it
	if (isset($db)) {
		$statement = null;
		$db = null;
	}
?>