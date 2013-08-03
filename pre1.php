<html lang="en">
  <head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	
  	<link rel="stylesheet" href="css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="css/style.css"></link>

  	<script type="text/javascript" src="js/jquery.min.js"></script>
  	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  </head>
  <body>

	<div class="container">
		<div class="row">

		    <img id="logo" src="img/bbq.svg">
			<div class="col-8"><h1>Welcome to the BBQueue!</h1></div>

			<div class="col-12">
				<h3>Your next election is in 34 days!</h3>

				<form class="form-horizontal" action="phone.php" method="post">
					<fieldset>
						<div class="form-group">
							<p class="col-12" class="help-block">Register and we'll tell you when lines at voting booths are short</p>
							<div class="col-10">
				              <input class="form-control" type="tel" id="phone" name="phone" placeholder="555-555-5555">
				            </div>
						</div>
						<button id="submit" type="submit" class="btn btn-primary">Submit</button>
					</fieldset>
				</form>
			</div>

		</div>
	</div>


  </body>
</html>