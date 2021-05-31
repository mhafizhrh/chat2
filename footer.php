	</div>
	<script type="text/javascript" src="bootstrap-4.3.1/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>
	<script src="jquery-3.4.1.js"></script>
	<script>
		$(document).ready(function() {
			setInterval(function() {
				$.ajax({

					url: "user-activity.php",
					success: function(result) {

						null;
					}
				})
			}, 1000);
		});
	</script>
</body>
</html>