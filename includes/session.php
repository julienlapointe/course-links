<?php

	// create a session file that is stored on the server
	session_start();
	
	// assemble and return message to be "echoed" to HTML
	function message() 
	{
		if (isset($_SESSION["message"])) 
		{
			// backslash (\) "escapes" the following character (ex. PHP does not interpret the first double quotes around "messages" as the end of the statement $output = "<div class=\" but instead interprets the full statement $output = "<div class=\"message\">"; and sends the double quotes in tact to be echoed as HTML)
			$output = "<div class=\"message\">";
			// htmlentities() converts characters to their HTML character entity equivalents (ex. "&" = "&amp;")
			// htmlspecialchars() only converts "special" characters (ex. ampersand, double and single quotes, "less than" and "greater than" symbols)
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	// assemble and return error message to be "echoed" to HTML
	function errors() 
	{
		if (isset($_SESSION["errors"])) 
		{
			// is this line needed anymore? I don't think so...
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>

<!-- do I ever need to close the session? like in step 5 of 5 for the SQL database connection? -->