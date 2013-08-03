<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="css/style.css"></link>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>

	<style>
	h1 {font-size: 8em !important;}
	body {text-align: center;}
	form {
		width: 400px;
		margin: 0 auto;
		margin-top: 50px;
		margin-bottom: 50px;
	}
	</style>

	<body>

	<div class="container">
		<div class="row">

			<div class="col-12"><h1>Fuck Queues</h1></div>

			<div class="col-12">
				<h4>The NYC primary election is in 38 days.</h4>
				<h4>Track and report your wait time at the polls.</h4>

				<form class="form-horizontal" action="index.php" method="post">
					<fieldset>
						<div class="form-group">
							<div>
				              <input class="form-control" type="tel" align="center" id="phone" name="phone" placeholder="(212) 555-5555">
				            </div>
						</div>
						<button id="submit" type="submit" class="btn btn-primary">Skip the wait</button>
					</fieldset>
				</form>

				<h4 style="font-style: italic">"Fuck the wait. Go vote."</h4>

			</div>
			
		</div>
	</div>


  </body>
</html>