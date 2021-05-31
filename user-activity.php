<?php

session_start();

date_default_timezone_set("Asia/Jakarta");

if (!isset($_SESSION['user_id'])) {
	
	$_SESSION['login_gagal'] = "Session timed out.";
	echo "<script>window.location.href = 'login.php';</script>";
} else {

	require 'koneksi.php';

	$user_id = $_SESSION['user_id'];
	$datetime = new DateTime();
	$datetime = $datetime->format("Y-m-d H:i:s");
	$ip_address = $_SERVER['REMOTE_ADDR'];

	mysqli_query($con, "UPDATE users SET last_activity = '{$datetime}' WHERE user_id = '{$user_id}'");
	mysqli_query($con, "UPDATE users SET ip_address = '{$ip_address}' WHERE user_id = '{$user_id}'");

	// $q_check = mysqli_query($con, "SELECT last_activity FROM users WHERE user_id = '{$user_id}'");
	// $a_activity = mysqli_fetch_array($q_check);

	// $last_activity = new DateTime($a_activity['last_activity']);
	// $datetime_now = new DateTime();
	// $diff_datetime = $datetime_now->format("U") - $last_activity->format("U");

	// echo $diff_datetime;

	// if ($diff_datetime <= 60) {
		
	// 	echo "Online";
	// } else {

	// 	echo "Offline";
	// }

	$group_id = $_GET['group_id'];

	$sql_group = mysqli_query($con, "SELECT * FROM group_user WHERE user_id = '{$user_id}' AND group_id = '{$group_id}'");

	if (mysqli_num_rows($sql_group) >= 0) {

		$sql_group2 = mysqli_query($con,
			"SELECT users.name AS user_name, groups.name AS group_name, users.last_activity, groups.owner_id, users.user_id
			FROM ((users
			LEFT JOIN group_user 
			ON users.user_id = group_user.user_id)
			LEFT JOIN groups 
			ON group_user.group_id = groups.group_id)
			WHERE groups.group_id = '{$group_id}'");

		echo "<li class='list-group-item d-flex justify-content-between align-items-center list-group-item-secondary'><b>" . mysqli_num_rows($sql_group2) . " Member(s)</b><span class='fa fa-users'></span></li>";

		while ($group_user = mysqli_fetch_array($sql_group2)) {

			$last_activity = new DateTime($group_user['last_activity']);
			$datetime_now = new DateTime();
			$diff_datetime = $datetime_now->format("U") - $last_activity->format("U");

			if ($diff_datetime <= 5) {
				
				$status = "Online";
				$badge = "success";
			} else {

				$status = "Offline";
				$badge = "light";
			}

			if ($group_user['owner_id'] == $group_user['user_id']) {
				
				// $delete_btn = "<div><span class='fa fa-trash' style='color:red'><span></div>";

				$badge_role = "<span class='fa fa-home'></span>";
			} else {

				$delete_btn = "<div><span class='fa fa-user'><span></div>";;
				if ($group_user['owner_id'] == $user_id) {

					$delete_btn = "<a href='delete-member.php?group_id={$group_id}&user_id={$group_user[user_id]}'><span class='fa fa-user-times' style='color:red'><span></a>";
				}

				$badge_role = null;
			}

			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>{$delete_btn}{$badge_role} {$group_user[user_name]} <span class='badge badge-{$badge} badge-pill'>$status</span></li>";
		}
	} else {

		echo "<script>window.location.href = 'index.php'; </script>";
	}
}

?>