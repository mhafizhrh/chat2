<?php 

session_start();
require 'koneksi.php';

if (isset($_POST['add'])) {
	
	$username = $_POST['username'];
	$group_id = $_GET['group_id'];

	if (trim($username) == "") {
		
		echo "<script>alert('Username Must be filled.'); window.location.href = 'room.php?group_id=$group_id'</script>";
	} else {

		// $q_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
		// $a_user = mysqli_fetch_array($q_user);
		// $q_group_user = mysqli_query($con, "SELECT * FROM group_user WHERE group_id = '$group_id' AND username = '{$a_user[user_id]}'");
		// $a_group_user = mysqli_fetch_array($q_group_user);

		// if (mysqli_num_rows($a_user) <= ) {
		// 	# code...
		// }

		$username = explode(";", $username);

		$user_added = array();

		for ($i = 0; $i < count($username); $i++) { 
			
			$q_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username[$i]'");
			$a_user = mysqli_fetch_array($q_user);

			if (mysqli_num_rows($q_user) >= 1) {
				
				$q_group_user = mysqli_query($con, "SELECT * FROM group_user WHERE group_id = '$group_id' AND user_id = '{$a_user[user_id]}'");

				if (mysqli_num_rows($q_group_user) <= 0) {

					mysqli_query($con, "INSERT INTO group_user VALUES ('{$a_user[user_id]}', '{$group_id}')");
					array_push($user_added, "{$username[$i]}");
				}
			}
		}

		if (count($user_added) >= 1) {

			$alert_user_added = "";

			for ($z = 0; $z < count($user_added); $z++) {
				
				$alert_user_added .= $user_added[$z] . ", ";
			}
		
			echo "<script>alert('{$alert_user_added}telah ditambahkan.'); window.location.href = 'room.php?group_id={$group_id}';</script>";
		} else {

			echo "<script>alert('Username not registered or User already exist!'); window.location.href = 'room.php?group_id={$group_id}';</script>";
		}

		// for ($i=0; $i < count($username); $i++) { 
		
		// 	$q_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
		// 	$a_user = mysqli_fetch_array($q_user);
		// 	$q_group_user = mysqli_query($con, "SELECT * FROM group_user WHERE group_id = '$group_id' AND username = '{$a_user[user_id]}'");
		// 	$a_group_user = mysqli_fetch_array($q_group_user);

		// 	if (mysqli_num_rows($a_user) <= ) {
		// 		# code...
		// 	}



		// 	$query = mysqli_query($con, "SELECT * FROM room WHERE group_id = '$group_id' AND username LIKE '%$username[$i]%'");
		// 	$query2 = mysqli_query($con, "SELECT * FROM user WHERE username = '$username[$i]'");
		// 	$data = mysqli_fetch_array($query);

		// 	if (mysqli_num_rows($query2) >= 1) {
				
		// 		if (mysqli_num_rows($query) <= 0) {

		// 			mysqli_query($con, "UPDATE room SET username = CONCAT(username, ';$username[$i]') WHERE group_id = '$group_id'");
		// 		}
		// 	}

		// 	if (($i + 1) == count($username)) {
				
		// 		header("location: room.php?group_id=$group_id");
		// 	}
		// }

		// if ($) {
		// 	# code...
		// }

		// for ($i=0; $i < count($explode2); $i++) { 
			
		// 	for ($x=0; $x < count($username); $x++) {

		// 		if ($explode2[$i] == $username[$x]) {
					

		// 		} else {

		// 			$query2 = mysqli_query($con, "SELECT * FROM room WHERE group_id = '$group_id'");
		// 			$data2 = mysqli_fetch_array($query2);
		// 			mysqli_query($con, "UPDATE room SET memberID = '$data2[memberID];$username[$x]' WHERE group_id = '$group_id'");
		// 		}
		// 	}

		// 	if ($i == count($explode2)) {
				
		// 		header("location: room.php?group_id=$group_id");
		// 	}
		// }
	}
}