<?php

session_start();

date_default_timezone_set("Asia/Jakarta");

if (!isset($_SESSION['user_id'])) {
	
	$_SESSION['login_gagal'] = "Session timed out.";
	echo "<script>window.location.href = 'login.php';</script>";
} else {

	require 'koneksi.php';

	$user_id = $_SESSION['user_id'];

	$sql_friends = mysqli_query($con, "SELECT *
		FROM user_friends
		WHERE (user1_id = '$user_id' OR user2_id = '$user_id') AND status = 1");
	// $sql_online = mysqli_query($con, "SELECT users.last_activity
	// 	FROM user_friends
	// 	LEFT JOIN users
	// 	ON user_friends.friend_id = users.user_id
	// 	WHERE user_friends.user_id = '{$user_id}'");

	if (mysqli_num_rows($sql_friends) >= 1) {

		echo "<li class='list-group-item d-flex justify-content-between align-items-center list-group-item-secondary'><b>" . mysqli_num_rows($sql_friends) . " Friends(s)</b><span class='fa fa-users'></span></li>";

		while ($user_friends = mysqli_fetch_array($sql_friends)) {

			if ($user_friends['user1_id'] != $user_id) {
				
				$friend_id = $user_friends['user1_id'];
			} else {

				$friend_id = $user_friends['user2_id'];
			}
			
			$sql_friends2 = mysqli_query($con, "SELECT last_activity, name FROM users WHERE user_id = '{$friend_id}'");
			$user_friends2 = mysqli_fetch_array($sql_friends2);

			$last_activity = new DateTime($user_friends2['last_activity']);
			$datetime_now = new DateTime();
			$diff_datetime = $datetime_now->format("U") - $last_activity->format("U");

			if ($diff_datetime <= 5) {
				
				$status = "Online";
				$badge = "success";
			} else {

				$status = "Offline";
				$badge = "light";
			}

			

			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>{$user_friends2[name]} <span class='badge badge-{$badge} badge-pill'>$status</span></li>";
		}
	} else {

		echo "<a href='friends.php' class='list-group-item list-group-item-action d-flex justify-content-between align-items-center list-group-item-primary'><span class='fa fa-user-plus'></span> Add new friend.</a>";
	}
}

?>