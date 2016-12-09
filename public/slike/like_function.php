<?php
function count_format($n, $point='.', $sep=',') {

	global $mysql_conn;

    if ($n < 0) {
        return 0;
    }

    if ($n < 10000) {
        return number_format($n, 0, $point, $sep);
    }

    $d = $n < 1000000 ? 1000 : 1000000;

    $f = round($n / $d, 1);

    return number_format($f, $f - intval($f) ? 1 : 0, $point, $sep) . ($d == 1000 ? 'k' : 'M');
}

function SmartLike($item_id,$style) {

	global $mysql_conn;

	include("like_lang.php");

	$user_ip = $_SESSION['user_id'];

	// $user_ip = $_SERVER['REMOTE_ADDR'];
	if(empty($item_id)) {
		return 'Error: <b>item_id</b> is empty.';
	} else {
		?>
		<link href="./slike/share.css" rel="stylesheet"/>
		<script type="text/javascript" src="./slike/like.js"></script>
		<span id="statusLike_<?php echo $item_id;?>">
		<?php
		if($style == "small_facebook") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			// if link has already been liked
			if(mysqli_num_rows($sql)>0) {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_type_facebook">
					<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['fb_small_count_text']; ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_small_liked']; ?></a>
				</div>
				<?php
			// if link has NOT been liked yet
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_type_facebook">
						<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['fb_small_count_text']; ?></span>
						<a class="share__btn__unclicked" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_small_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_type_facebook">
					<span class="share__count"><?php echo $lang['fb_small_first_like']; ?></span>
					<a class="share__btn__unclicked" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_small_like']; ?></a>
				</div>
				<?php
				}
			}
		} elseif($style == "small_twitter") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			if(mysqli_num_rows($sql)>0) {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_type_twitter">
					<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['tw_small_count_text']; ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_small_liked']; ?></a>
				</div>
				<?php
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_type_twitter">
						<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['tw_small_count_text']; ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_small_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_type_twitter">
					<span class="share__count"><?php echo $lang['tw_small_first_like']; ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_small_like']; ?></a>
				</div>
				<?php
				}
			}
		} elseif($style == "small_googleplus") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			if(mysqli_num_rows($sql)>0) {
			    $sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_type_gplus">
					<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['gp_small_count_text']; ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_small_liked']; ?></a>
				</div>
				<?php
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_type_gplus">
						<span class="share__count"><?php echo number_format($count); ?> <?php echo $lang['gp_small_count_text']; ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_small_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_type_gplus">
					<span class="share__count"><?php echo $lang['gp_small_first_like']; ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_small_like']; ?></a>
				</div>
				<?php
				}
			}
		} elseif($style == "big_facebook") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			if(mysqli_num_rows($sql)>0) {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_size_large share_type_facebook">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_big_liked']; ?></a>
				</div>
				<?php
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_size_large share_type_facebook">
						<span class="share__count"><?php echo count_format($count); ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_big_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_size_large share_type_facebook">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['fb_big_like']; ?></a>
				</div>
				<?php
				}
			}
		} elseif($style == "big_twitter") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			if(mysqli_num_rows($sql)>0) {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_size_large share_type_twitter">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_big_liked']; ?></a>
				</div>
				<?php
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_size_large share_type_twitter">
						<span class="share__count"><?php echo count_format($count); ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_big_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_size_large share_type_twitter">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['tw_big_like']; ?></a>
				</div>
				<?php
				}
			}
		} elseif($style == "big_googleplus") {
			$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id' and user_ip='$user_ip'");
			if(mysqli_num_rows($sql)>0) {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				$count = mysqli_num_rows($sql);
				?>
				<div class="share share_size_large share_type_gplus">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="unlike('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_big_liked']; ?></a>
				</div>
				<?php
			} else {
				$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
				if(mysqli_num_rows($sql)>0) {
					$sql = mysqli_query($mysql_conn, "SELECT * FROM likes WHERE item_id='$item_id'");
					$count = mysqli_num_rows($sql);
					?>
					<div class="share share_size_large share_type_gplus">
						<span class="share__count"><?php echo count_format($count); ?></span>
						<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_big_like']; ?></a>
					</div>
					<?php
				} else {
				?>
				<div class="share share_size_large share_type_gplus">
					<span class="share__count"><?php echo count_format($count); ?></span>
					<a class="share__btn" href="javascript:void(0);" onclick="like('<?php echo $item_id; ?>','<?php echo $user_ip; ?>','<?php echo $style; ?>')"><?php echo $lang['gp_big_like']; ?></a>
				</div>
				<?php
				}
			}
		} else {
			return 'Error: undefined style.';
		}
		?>
		</span>
		<?php
	}
}
?>