		
		<?php

				require 'koneksi.php';
				$group_id = $_GET['group_id'];
				$user_id = $_GET['user_id'];
				$query2 = mysqli_query($con,
					"SELECT *
					FROM ((group_message LEFT JOIN messages ON group_message.message_id = messages.message_id)
					LEFT JOIN users ON messages.user_id = users.user_id)
					WHERE group_message.group_id = '$group_id' AND messages.deleted = 0
					ORDER BY messages.message_id DESC
					LIMIT 30
				");

				$q_check = mysqli_query($con, "SELECT * FROM group_user WHERE user_id = '{$user_id}' AND group_id = '{$group_id}'");

				if (mysqli_num_rows($q_check) >= 1) {
				
					while ($data2 = mysqli_fetch_array($query2)) {

						if ($data2['user_id'] == $user_id) {
							
							$alert = "primary";
							$id = " (You)";
							$delete_btn = "<a href='delete-message.php?message_id=$data2[message_id]&group_id=$group_id'><span class='fa fa-trash' style='color:red'></span></a> ";
						} else {

							$alert = "secondary";
							$id = null;
							$delete_btn = null;
						}

						echo "

							<div class='alert alert-$alert'>
								<p class='pull-right'>$data2[sent_at]</p>
								<h6><b>$delete_btn $data2[name] $id</b></h6>
								<p>$data2[message]</p>
							</div>
						";
					}
				} else {

					echo "<script>alert('You are no longer a member now.'); window.location.href = 'index.php';</script>";
				}
