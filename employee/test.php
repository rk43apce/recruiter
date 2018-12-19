<!DOCTYPE html>
<html>
<head>

	<style>
		.card label {
		text-align: right;
		}
		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('../img/processing.gif') 50% 50% no-repeat rgb(249,249,249);
			opacity: .8;
		}
	</style>
	

</head>

<body>
	<div class="loader"></div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript">
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	});
	</script>
</body>
</html>
</html>