<?php require 'header.php'; ?>

<div class="row">
	<div class="col-12 col-md-12">
		<center>
			<a href="index.php" class="btn btn-outline-dark btn-block"><span class="fa fa-angle-left"></span> Back to Home</a>
		</center>
		<br>

		<?php

		require 'koneksi.php';
		session_start();

		if (isset($_POST['create'])) {
			
			$user_id = $_SESSION['user_id'];
			$roomName = strip_tags($_POST['roomName']);
			// $username = strip_tags($_POST['username']);

			$groups_q = mysqli_query($con, "SELECT MAX(group_id) AS group_id FROM groups");
			$groups_a = mysqli_fetch_array($groups_q);
			$group_id = $groups_a['group_id'] + 1;

			if (trim($roomName) == "") {
				
				echo "<div class='alert alert-danger'>Room Name Must be filled.</div>";
			} else {

				$query = mysqli_query($con, "INSERT INTO groups (group_id, owner_id, name) VALUES ('{$group_id}', '{$user_id}', '{$roomName}')");
				$query = mysqli_query($con, "INSERT INTO group_user (user_id, group_id) VALUES ('$user_id', '$group_id')");

				if ($query) {

					echo "<div class='alert alert-success'>Room <a href='room.php?group_id={$group_id}'>{$roomName}</a> created</div>";
					echo "<script>window.location.href = 'room.php?group_id={$group_id}';</script>";
				} else {

					echo "<div class='alert alert-danger'>Create room failed.</div>";
				}

				// echo "<script>window.location.href = 'room.php?group_id={$group_id}';</script>";
			}
		}

		?>

		<div class="card">
			<div class="card-header text-center">
				<h3>CREATE NEW ROOM</h3>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label>Room Name :</label>
						<input type="text" name="roomName" class="form-control" placeholder="EX : MY FAMILY">
					</div>
					<!-- <div class="form-group">
						<label>Add your friends to the room :</label>
						<input type="text" name="username" class="form-control" placeholder="@Username">
						<label style="color: red">* Separate with semicolon to add more friend to the Room. Ex : friend1;older_sister;mom</label>
					</div> -->
					<div class="form-group">
						<button class="btn btn-outline-dark btn-block" name="create"><span class="fa fa-plus"></span> Create</button>
					</div>
				</form>
			</div>
		</div>

		<?php

		// $string = "1253";
		// $sArr = toArr($string);
		// echo implode(";", $sArr);
		// $imp = implode(";", $sArr);
		// $exp = explode(";", $imp);
		// echo " your pick : " . $exp[2];

		// for ($i = 0; $i < count($exp); $i++) {
			
		// 	if ($exp[$i] == "5") {
		// 		echo $exp[$i];
		// 	} else {

		// 		echo "you are dead";
		// 	}
		// }
		?>
	</div>
</div>

<?php require 'footer.php'; ?>