<?php require 'header.php'; ?>

<div class="row">
	<div class="col-md-4 col-sm-12">
		<div class="card">
			<div class="card-header text-center"><b>Add New Friend.</b></div>
			<div class="card-body">
				<form action="add-friend.php" method="post">
					<div class="form-group">
						<label for="username">Username :</label>
						<input type="text" name="username" id="username" class="form-control">
					</div>
					<div class="form-group">
						<button class="btn btn-outline-secondary btn-block"><span class="fa fa-user-plus"></span> Add Friend</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">
		<div class="card">
			<div class="card-header text-center"><b>Friend List</b></div>
			<div class="card-body">
				<div class="d-flex flex-column" style="max-height: 450px; overflow-y: auto;">
					<ul class="list-group list-group-flush" id="friends_list">
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">
		<div class="card">
			<div class="card-header text-center"><b>Friend request</b></div>
			<div class="card-body">
				<div class="d-flex flex-column" style="max-height: 450px; overflow-y: auto;">
					<ul class="list-group list-group-flush">
						<?php

						require 'koneksi.php';

						$user_id = $_SESSION['user_id'];

						$query = mysqli_query($con, "SELECT *
							FROM user_friends
							WHERE (user1_id = '$user_id' OR user2_id = '$user_id') AND status = 0 AND user_request_id != '{$user_id}'");

						if (mysqli_num_rows($query) <= 0) {
							
							echo "<li class='list-group-item list-group-item-secondary'>No Friend request, try refreshing the page.</li>";
						} else {

							while ($pending_data = mysqli_fetch_array($query)) {
								
								if ($pending_data['user1_id'] != $user_id) {
					
									$friend_id = $pending_data['user1_id'];
									$column = "user1_id";
								} else {

									$friend_id = $pending_data['user2_id'];
									$column = "user2_id";
								}

								$query2 = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$friend_id'");
								$friend_data = mysqli_fetch_array($query2);

								echo "
								<li class='list-group-item d-flex justify-content-between align-items-center'>
								{$friend_data[name]}
								<a href='friend-request.php?friend_id={$friend_id}&request=1&column={$column}' class='badge badge-success'><span class='fa fa-check-square-o'></span> Accept</a>
								<a href='friend-request.php?friend_id={$friend_id}' class='badge badge-danger'><span class='fa fa-times'></span> Decline</a>
								</li>
								";
							}
						}

						?>
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