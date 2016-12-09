<?php
	// define constants (IN CAPS) for server / database authentication
	// server
	define("DB_SERVER", "localhost");
	// database name (a server can host many databases)
	define("DB_NAME", "course_links");
	// server username
	define("DB_USERNAME", "root");
	// server password
	define("DB_PASSWORD", "root");
	
	// step 1 of 5: create database connection
	// try-catch statement used to catch errors "thrown" by PHP
	// attempt connection
	try
	{
		// specifies the type, host, db name, character set, username, and password
		$db = new PDO('mysql:host='.DB_SERVER.'; dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
		// sets error mode, which allows errors to be thrown instead of silently ignored
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// experiment with persistent connections to db server for faster performance: http://php.net/manual/en/pdo.connections.php
		// $db = new PDO("mysql:host={$DB_SERVER}, dbname={$DB_NAME}", $DB_USERNAME, $DB_PASSWORD, array(PDO::ATTR_PERSISTENT=>TRUE));
	}
	// if unsuccessful, throw errors
	catch (PDOException $error)
	{
		echo "ERROR: " . $error->getMessage();
		// die();
	}
?>
