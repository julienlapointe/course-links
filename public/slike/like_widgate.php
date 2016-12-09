<?php require_once("../../includes/session.php"); ?>
<?php
include("../like_config.inc.php");
include("like_function.php");
$action = $_GET['action'];
$item_id = $_GET['item_id'];
$style = $_GET['style'];
$user_ip = $_SESSION['user_id'];

global $mysql_conn;

if($action == "like") {
	$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
	if(mysqli_num_rows($sql)>0) {
		echo SmartLike($item_id,$style);
	} else {
		$insert = mysqli_query($mysql_conn, "INSERT likes (item_id,user_ip) VALUES ('$item_id','$user_ip')");
		echo SmartLike($item_id,$style);
	}
} elseif($action == "unlike") {
	$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
	if(mysqli_num_rows($sql)>0) {
		$remove = mysqli_query($mysql_conn, "DELETE FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
		echo SmartLike($item_id,$style);
	} else {
		echo SmartLike($item_id,$style);
	}
} else {
	echo 'Hacking attempt!';
}
?>