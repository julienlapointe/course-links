<?php
	
	// search
	function search_results_for($query)
	{
		global $db;
		
		$sql1 = "SELECT * FROM courses WHERE name LIKE :query";
		$sql2 = "SELECT * FROM links WHERE title LIKE :query";
		$sql3 = "SELECT * FROM users WHERE username LIKE :query";

		$result_set = array();

		try
		{
			$statement1 = $db->prepare($sql1);
			$statement1->bindParam(':query', $query);
			$statement1->execute();
			while ($row = $statement1->fetch(PDO::FETCH_ASSOC))
			{
				$result_set[] = $row;
			}
			$statement2 = $db->prepare($sql2);
			$statement2->bindParam(':query', $query);
			$statement2->execute();
			while ($row = $statement2->fetch(PDO::FETCH_ASSOC))
			{
				$result_set[] = $row;
			}
			$statement3 = $db->prepare($sql3);
			$statement3->bindParam(':query', $query);
			$statement3->execute();
			while ($row = $statement3->fetch(PDO::FETCH_ASSOC))
			{
				$result_set[] = $row;
			}
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($result_set) 
		{
			return $result_set;
		} else {
			return null;
		}
	}

	// redirects user to a different file / page
	function redirect_to($new_location) 
	{
		header("Location: " . $new_location);
		exit;
	}
	
	// assembles the error message ($errors is an empty array by default)
	// NOTE TO SELF: create a function for "success" messages too?
	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) 
		{
			$output .= "<div class=\"error\">";
			$output .= "Please fix the following errors:";
			$output .= "<ul>";
			foreach ($errors as $key => $error) 
			{
				$output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}

	// assembles an SQL query for retrieving all course records ($public is true by default)
	function find_all_courses($public=true) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM courses ";
		if ($public) 
		{
			$sql .= "WHERE visible = 1 ";
		}
		$sql .= "ORDER BY position ASC";
		try
		{
			$statement = $db->prepare($sql);
			$statement->execute();
			$course_set = $statement->fetchAll();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		return $course_set;
	}

	// assembles an SQL query for retrieving all course records ($public is true by default)
	function find_all_links($public=true) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM links ";
		if ($public) 
		{
			$sql .= "WHERE visible = 1 ";
		}
		$sql .= "ORDER BY date_posted DESC";
		try
		{
			$statement = $db->prepare($sql);
			$statement->execute();
			$link_set = $statement->fetchAll();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		return $link_set;
	}
	
	// assembles an SQL query for retrieving all link record(s) by course ID ($public is true by default)
	function find_links_for_course($course_id, $user_context) 
	{
		global $db;
		// it is probably better to return $row_count in an array alongside $link_set, but creating global var $row_count was faster
		global $row_count;
		
		$sql  = "SELECT * ";
		$sql .= "FROM links ";
		$sql .= "WHERE course_id = :course_id ";
		// only show visible links to users (admins can see everything)
		if ($user_context == "guest") 
		{
			$sql .= "AND visible = 1 ";
		}
		$sql .= "ORDER BY position ASC";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":course_id", $course_id);
			$statement->execute();
			$link_set = $statement->fetchAll();
			$row_count = $statement->rowCount();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		return $link_set;
	}
	
	// assembles an SQL query for retrieving all user records
	function find_all_users() 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM users ";
		$sql .= "ORDER BY username ASC";
		try
		{
			$statement = $db->prepare($sql);
			$statement->execute();
			$user_set = $statement->fetchAll();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		return $user_set;
	}
	
	// assembles an SQL query for retrieving course record by course ID (used for "DELETE" action) ($public is true by default)
	function find_course_by_id($course_id, $public=true) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM courses ";
		$sql .= "WHERE id = :course_id ";
		if ($public) 
		{
			$sql .= "AND visible = 1 ";
		}
		$sql .= "LIMIT 1";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":course_id", $course_id);
			$statement->execute();
			$course = $statement->fetch();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($course) 
		{
			return $course;
		} else {
			return null;
		}
	}

	// assembles an SQL query for retrieving link record by link ID (used for "DELETE" action) ($public is true by default)
	function find_link_by_id($link_id, $public=true) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM links ";
		$sql .= "WHERE id = :link_id ";
		if ($public) {
			$sql .= "AND visible = 1 ";
		}
		$sql .= "LIMIT 1";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":link_id", $link_id);
			$statement->execute();
			$link = $statement->fetch();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($link) {
			return $link;
		} 
		else 
		{
			return null;
		}
	}
	
	// assembles an SQL query for retrieving user record by user ID (used for "DELETE" action)
	function find_user_by_id($user_id) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM users ";
		$sql .= "WHERE id = :user_id ";
		$sql .= "LIMIT 1";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":user_id", $user_id);
			$statement->execute();
			$user = $statement->fetch();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($user) 
		{
			return $user;
		} 
		else 
		{
			return null;
		}
	}

	// assembles an SQL query for retrieving user record by username (used for "LOGIN" action)
	function find_user_by_username($username) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM users ";
		$sql .= "WHERE username = :username ";
		$sql .= "LIMIT 1";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":username", $username);
			$statement->execute();
			$user = $statement->fetch();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($user) 
		{
			return $user;
		} 
		else 
		{
			return null;
		}
	}

	// assembles an SQL query for retrieving the *first* link record for a course ID
	function find_default_link_for_course($course_id) 
	{
		global $db;
		
		$sql  = "SELECT * ";
		$sql .= "FROM links ";
		$sql .= "WHERE course_id = :course_id ";
		$sql .= "ORDER BY position ASC ";
		$sql .= "LIMIT 1";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":course_id", $course_id);
			$statement->execute();
			$first_link = $statement->fetch();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($first_link) 
		{
			return $first_link;
		} 
		// otherwise there's no default link so return NULL
		else 
		{
			return null;
		}
	}

	// find out if user has upvoted link already
	function find_link_vote_status_for_user($user_id, $link_id)
	{
		global $db;
		global $row_count2;
		
		$sql  = "SELECT * ";
		$sql .= "FROM link_votes ";
		$sql .= "WHERE user_id = :user_id ";
		$sql .= "AND link_id = :link_id";
		try
		{
			$statement = $db->prepare($sql);
			$statement->bindParam(":user_id", $user_id);
			$statement->bindParam(":link_id", $link_id);
			$statement->execute();
			$row_count2 = $statement->rowCount();
			$link_like_status = $statement->fetchAll();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		if($link_like_status) 
		{
			return $link_like_status;
		} 
		// otherwise there's no default link so return NULL
		else 
		{
			return null;
		}
	}

	// sets the ID values for $current_link and $current_course (used for applying the "selected" CSS class)
	// NOTE TO SELF: break into 2 functions? set_current_course() and set_current_link()
	function set_current_course_link($public=false) 
	{
		global $current_course;
		global $current_link;
		// checks if value of "course" key in $_GET super global variable is set / is not NULL
		if (isset($_GET["course"])) 
		{
			// set $current_course to value of "course" key in $_GET super global variable set by previous page via URL parameters
			$current_course = find_course_by_id($_GET["course"], $public);
			if ($current_course && $public) 
			{
				// NOTE TO SELF: no need for find_default_link_for_course() anymore, right?
				$current_link = find_default_link_for_course($current_course["id"]);
			} 
			else 
			{
				$current_link = null;
			}
		} elseif (isset($_GET["link"])) 
		{
			$current_course = null;
			$current_link = find_link_by_id($_GET["link"], $public);
		} 
		else 
		{
			$current_course = null;
			$current_link = null;
		}
	}

	// prepares navigation (visible only to admins) to be "echoed"
	// prepares public navigation (visible to all users) to be "echoed"
	// navigation takes 2 arguments: (1) current course array or null (2) current link array or null
	function navigation($course_array, $user_context) 
	{
		// backlashes (\) escape "double quotes" so that PHP doesn't interpret a premature end to the statement
		$output = "<br><ul>";
		$course_set = find_all_courses();
		// steps through courses one record at a time
		foreach($course_set as $course) 
		{
			// outputs courses as list items
			$output .= "<li";
			if ($course_array && $course["id"] == $course_array["id"]) 
			{
				// applies .selected class to course list item
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			if ($user_context == "admin")
			{
				$output .= "<a href=\"manage_content.php?course=";
			}
			else
			{
				$output .= "<a href=\"index.php?course=";
			}
			$output .= urlencode($course["id"]);
			$output .= "\">";
			$output .= htmlentities($course["name"]);
			$output .= "</a>";
			$output .= "</li><br>"; // end of the course li
		}
		// release space on server used for course SQL query
		// cannot get this to work...
		// mysqli_free_result($course_set);
		// $course_set->closeCursor();
		$output .= "</ul>";
		// "return" must be the last line of the function because code below "return" will NOT be executed
		return $output;
	}

	// generates a salt of specified length (22 in this case) for use in the password_encrypt() function below
	function generate_salt($length) {
		// not 100% unique / random, but good enough for a salt
		// MD5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));
		// valid characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);
		$modified_base64_string = str_replace('+', '.', $base64_string);
		// truncate string to the correct length
		$salt = substr($modified_base64_string, 0, $length);
		return $salt;
	}

	// creates a hashed password from the $password string using the salt generated in the above function
	function password_encrypt($password) 
	{
		// tells PHP to use Blowfish with a "cost" of 10
		$hash_format = "$2y$10$";   
		// Blowfish salts should be at least 22 characters long
		$salt_length = 22; 					
		$salt = generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	// encrypts password string entered by user and compares it to the user's hashed password stored in Users table of database
	function password_check($password, $existing_hash) 
	{
		// existing hash contains format and salt at start
		$hash = crypt($password, $existing_hash);
		if ($hash === $existing_hash) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	// checks if username and password exist in Users table of database (for "LOGIN" action)
	function attempt_login($username, $password) 
	{
		$user = find_user_by_username($username);
		if ($user) 
		{
			// found user, now check password
			if (password_check($password, $user["hashed_password"])) 
			{
				// password matches
				return $user;
			} 
			else 
			{
				// password does not match
				return false;
			}
		} 
		else 
		{
			// user not found
			return false;
		}
	}

	// checks if the user is logged in (if the $_SESSION file contains a value the "for user_id" key)
	function logged_in() 
	{
		return isset($_SESSION['user_id']);
	}
	
	// redirects user to login page if not logged in
	function confirm_logged_in() 
	{
		if (!logged_in()) 
		{
			redirect_to("login.php");
		}
	}

?>