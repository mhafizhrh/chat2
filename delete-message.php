<?php

require 'koneksi.php';

if (isset($_GET['message_id'])) {
	
	$message_id = $_GET['message_id'];
	$group_id = $_GET['group_id'];

	$query = mysqli_query($con, "UPDATE messages SET deleted = 1 WHERE message_id = '{$message_id}'");

	if ($query) {
		
		header("location: room.php?group_id=$group_id");
	} else {

		header("location: room.php?group_id=$group_id");
	}
}

?>