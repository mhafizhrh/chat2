<?php

session_start();
date_default_timezone_set("Asia/Jakarta");
require 'koneksi.php';

$user_id = $_SESSION['user_id'];

if (isset($_POST['message']) && isset($_POST['group_id'])) {
	
	$message = nl2br(strip_tags($_POST['message']));
	$group_id = $_POST['group_id'];

	$q_check = mysqli_query($con, "SELECT * FROM group_user WHERE user_id = '{$user_id}' AND group_id = '{$group_id}'");

	if (mysqli_num_rows($q_check) >= 1) {

		if (trim($message) == "" || $_POST['group_id'] == 0) {
			
			echo "<script>alert('Message must be filled.')</script>";
		} else {

			$id_q = mysqli_query($con, "SELECT MAX(message_id) AS message_id FROM messages");
			$id_a = mysqli_fetch_array($id_q);

			if (mysqli_num_rows($id_q) <= 0) {
				
				$message_id = 0;
			} else {

				$message_id = $id_a['message_id'] + 1;
			}

			mysqli_query($con,
				"INSERT INTO messages
				(message_id, user_id, message)
				VALUES
				($message_id, '$user_id', '$message')");
			mysqli_query($con,
				"INSERT INTO group_message
				(message_id, group_id)
				VALUES
				($message_id, '$group_id')");
		}
	} else {

		echo "<script>alert('You are no longer a member now.'); window.location.href = 'index.php';</script>";
	}
}

?>