<?php
include("../like_config.inc.php");
include("like_function.php");
$action = $_GET['action'];
$item_id = $_GET['item_id'];
$style = $_GET['style'];
// $user_ip = $_GET['user_ip'];
$user_ip = $_SESSION['user_id'];

echo SmartLike($item_id,$style);
?>