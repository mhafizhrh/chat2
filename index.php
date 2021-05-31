<?php require 'header.php'; ?>
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-center"><b>ROOM LIST</b></div>
			<div class="card-body text-center">
				<div class="list-group">
					<a href="create-room.php" class="list-group-item list-group-item-action list-group-item-primary" style="color: black;"><span class="fa fa-plus"></span> New Room</a></li>
					<?php

					require 'koneksi.php';
					session_start();

					// $q_profil = mysqli_query($con, "SELECT username FROM user WHERE IdUser = '".$_SESSION['IdUser']."'");
					// $data = mysqli_fetch_array($q_profil);
					// $username = $data['username'];

					// $query = mysqli_query($con, "SELECT * FROM room WHERE memberID LIKE '%$username%' GROUP BY IdRoom ORDER BY IdRoom DESC LIMIT 10");

					$sql_group = mysqli_query($con,
						"SELECT * FROM group_user
						LEFT JOIN groups 
						ON group_user.group_id = groups.group_id
						WHERE group_user.user_id = '$user_id'
						GROUP BY groups.group_id
						ORDER BY groups.group_id DESC");

					while ($group_data = mysqli_fetch_array($sql_group)) {

						$sql_group2 = mysqli_query($con,
							"SELECT group_id FROM group_user
							WHERE group_id = '{$group_data[group_id]}'");
					?>
					<a href="room.php?group_id=<?=$group_data['group_id']?>" class="list-group-item list-group-item-action"><?=$group_data['name'];?> <span class="badge badge-primary badge-pill"><span class="fa fa-users"></span> <?=mysqli_num_rows($sql_group2);?></span></a>
					<?php
					
					}

					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header text-center"><b>FRIENDS</b></div>
			<div class="card-body">
				<div class="d-flex flex-column" style="max-height: 450px; overflow-y: auto;">
					<ul class="list-group list-group-flush" id="friends_list">
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="jquery-3.4.1.js"></script>
<script>
	$(document).ready(function() {

		setInterval(function() {
			$.ajax({

				url: "friend-list.php",
				// data: {group_id : },
				// type: "GET",
				// dataType: "html",
				success: function(result) {

					$("#friends_list").html(result);
				}
			})
		}, 1000);
	});
</script>
<?php require 'footer.php'; ?>