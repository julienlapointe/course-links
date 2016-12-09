<?php

	$errors = array();

	// converts database table column titles into presentable titles for output to user (ex. "first_name" becomes "First name")
	function fieldname_as_text($fieldname) 
	{
		$fieldname = str_replace("_", " ", $fieldname);
		$fieldname = ucfirst($fieldname);
		return $fieldname;
	}

	// NOTE: this function is only used once in function validate_presences() below; it makes that function easier to read
	// checks if parameter $value holds a value / is "set" / is not NULL
	// use === or !== to avoid false positives
	function has_presence($value) 
	{
		return isset($value) && $value !== "";
	}

	// checks if the array of values $required_fields (parameter) holds a value / is "not empty"
	// use trim() so empty spaces don't count, otherwise an empty string (ex. "     ") would be considered to hold a value / be "set" / not be NULL 
	// empty() would consider "0" to be empty
	function validate_presences($required_fields) 
	{
		global $errors;
		foreach($required_fields as $field) 
		{
			$value = trim($field);
			// if a $field is empty, add its key to an error message in the $errors object
			if (!has_presence($value)) 
			{
				$errors[$field] = fieldname_as_text($field) . " can't be blank";
			}
		}
	}

	// NOTE: this function is only used once in function validate_max_lengths() below; it makes that function easier to read
	// returns TRUE (1) if $value string has fewer or an equal number of characters as integer $max
	function has_max_length($value, $max) 
	{
		return strlen($value) <= $max;
	}

	// receives an associative array as parameter, where each key relates to a $_POST key and each value holds the respective maximum length for that key 
	// NOTE TO SELF: swap $_POST[$field] for $field and leave $_POST where function is called? like in validate_presences() above?
	function validate_max_lengths($fields_with_max_lengths) 
	{
		global $errors;
		foreach($fields_with_max_lengths as $field => $max) 
		{
			$value = trim($_POST[$field]);
			// if a $value is longer than the $max length, add its key to an error message in the $errors object
			if (!has_max_length($value, $max)) 
			{
				$errors[$field] = fieldname_as_text($field) . " is too long";
			}
		}
	}

?>