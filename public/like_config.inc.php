<?php
$mysql_host = 'localhost'; // Enter MySQL Server host. Eg: localhost
$mysql_user = 'root'; // Enter MySQL Server user. Eg: root
$mysql_pass = 'root'; // Enter MySQL User password.
$mysql_base = 'course_links'; // Enter MySQL Database. Eg: slike
	
$mysql_conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_base);
// $mysql_sel_db = mysqli_select_db(,$mysql_conn);
// global $mysql_conn;
?>
