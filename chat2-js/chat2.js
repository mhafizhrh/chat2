$(document).ready(function() {
	setInterval(function() {
		$.ajax({

			url: "user-activity.php",
			success: function(result) {

				null;
			},
			error: function() {

				alert("ERROR");
			}
		})
	}, 100);
});