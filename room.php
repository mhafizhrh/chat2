<?php require 'header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<?php

		require 'koneksi.php';

		if (isset($_GET['group_id'])) {
			
			$group_id = $_GET['group_id'];
			$sql_group = mysqli_query($con,
				"SELECT *
				FROM group_user
				LEFT JOIN groups
                ON group_user.group_id = groups.group_id
				WHERE group_user.group_id = '{$group_id}' AND group_user.user_id = '{$user_id}'");
			$group_data = mysqli_fetch_array($sql_group);

			if (mysqli_num_rows($sql_group) >= 1) {
				
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header text-center"><b><?=$group_data['name']?></b></div>
			<div class="card-body">
				<div class="d-flex flex-column-reverse" style="min-height: 450px; max-height: 450px; overflow-y: auto;" id="chatBox">

				</div>
				<div class="input-group" id="inputMsg">
					<textarea class="form-control" id="message" rows="2" placeholder="Type here...."></textarea>
					<div class="input-group-append">
						<button type="submit" id="send" class="btn btn-outline-primary"><span class="fa fa-send"></span></button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header text-center"><b>MEMBER LIST</b></div>
			<div class="card-body">
				<form method="post" action="add-member.php?group_id=<?=$_GET['group_id']?>">
					<div class="form-group">
						<label>Add your Friend to the group :</label>
						<input type="text" name="username" class="form-control" placeholder="username1;username2;username3">
						<input value="<?=$_GET['group_id']?>" name="group_id" hidden>
						<label style="color: red">* Separate with semicolon to add more people to the group. Ex : friend1;older_sister;mom</label>
					</div>
					<div class="form-group">
						<button class="btn btn-outline-secondary btn-block" name="add"><span class="fa fa-user-plus"></span> Add</button>
					</div>
				</form>
				<hr>
				<div class="d-flex flex-column" style="min-height: 450px; max-height: 450px; overflow-y: auto;">
					<ul class="list-group list-group-flush" id="group-user">
					</ul>
				</div>
			</div>
		</div>
	</div>

		<?php

			} else {

				echo "<center><h3>group not found.</h3></center>";
			}
		} else {

			header("location: index.php");
		}

		?>
</div>
<script src="jquery-3.4.1.js"></script>
<script>
	$(document).ready(function() {

		setInterval(function() {
			$.ajax({

				url: "user-activity.php",
				data: {group_id : <?php echo $_GET['group_id'] ?>},
				type: "GET",
				dataType: "html",
				success: function(result) {

					$("#group-user").html(result);
				}
			})
		}, 1000);

		// Chat Box
		setInterval(function() {
		$.ajax({
			url: "chat-box.php",
			data: {group_id: <?php echo $_GET['group_id'] ?>, user_id: <?php echo $_SESSION['user_id'] ?>},
			type: "GET",
			dataType: "html",
			success: function(result) {

				$("#chatBox").html(result);
			}
		});
		}, 300);

		$("#send").click(function() {
			var message = $("#message").val();
			var group_id = $("#group_id").val();
			$.ajax({
				url: "send-message.php",
				data: {message: message, group_id: <?php echo $_GET['group_id'] ?>},
				type: "POST",
				dataType: "html",
				beforeSend: function() {

					$("#send").attr("disabled", "true");
					$("#send").html("<span class='fa fa-spinner fa-spin'></span>");
				},
				success: function(result) {

					$("#send").removeAttr("disabled");
					$("#send").html("<span class='fa fa-send'></span>");
					$("#message").val("").empty();
				},
				error: function() {

					alert("Error");
					$("#message").val("").empty();
				}
			});
		});

		$("#message").keyup(function(e) {

			if (e.shiftKey) {

				var text = this.value;
				this.value = text;
			} else if (e.keyCode === 13) {

				var message = $("#message").val().trim();
				var group_id = $("#group_id").val();
				$.ajax({
					url: "send-message.php",
					data: {message: message, group_id: <?php echo $_GET['group_id'] ?>},
					type: "POST",
					dataType: "html",
					beforeSend: function() {

						$("#send").attr("disabled", "true");
						$("#send").html("<span class='fa fa-spinner fa-spin'></span>");
					},
					success: function(result) {

						$("#send").removeAttr("disabled");
						$("#send").html("<span class='fa fa-send'></span>");
						$("#message").val("").empty();
					},
					error: function() {

						alert("Error");
						$("#message").val("").empty();
					}
				});
			}
		});
	});
</script>
<?php require 'footer.php'; ?>