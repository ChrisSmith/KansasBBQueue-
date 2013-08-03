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
			<div class="col-8"><h1>Happy election day!</h1></div>

			<div class="col-12">
							
				<form class="form-horizontal" method="post">
					<fieldset>
						<div class="form-group">
							<p class="col-12" class="help-block">Check the wait time at your polling place or, if you're in line, tell us how long your wait is.</p>
				            <label class="col-2" for="street-num">Street number:</label>
				            <div class="col-10">
				              <input class="form-control" type="tel" id="street-num" name="street-num" value="300">
				            </div>
						</div>

						<div class="form-group">
							<label class="col-2" for="street">Street:</label>
							<div class="col-10">
							  <input class="form-control" type="tel" id="street" name="street" value="W 23rd St">
							</div>
						</div>

						<div class="form-group">
							<label class="col-2" for="street">City:</label>
							<div class="col-10">
							  <input class="form-control" type="text" id="city" name="city" value="New York">
							</div>
						</div>

						<div class="form-group">
							<label class="col-2" for="state">State:</label>
							<div class="col-10">

							  <?php

							      $states_arr = array('KS'=>"Kansas",'NY' => "New York");

							      function showOptionsDrop($array, $active, $echo=true){
							          $string = '';

							          foreach($array as $k => $v){
							              $s = ($active == $k)? ' selected="selected"' : '';
							              $string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
							          }

							          if($echo)   echo $string;
							          else        return $string;
							      }
							  ?>
							  <select name="state" class="form-control">
							    <option value="0">Choose a state</option>
							    <?php showOptionsDrop($states_arr, null, true); ?>
							  </select>
							</div>
						</div>

						<div class="form-group">
							<label class="checkbox-inline col-4">
								<input type="radio" name="checkin" value="get"> Check your wait time </input>
							</label>
							<label class="checkbox-inline col-4">
								<input type="radio" name="checkin" value="report"> Report your wait time </input>
							</label>
						</div>
				          
						<button id="submit" type="submit" class="btn btn-primary">Submit</button>

						<script>
						$('#submit').on('click', function() {
							var buttons = document.getElementsByName('checkin');
							$.each(buttons, function() {
								if (this.checked) {
									$('.form-horizontal')[0].action = this.value + 'Wait.php';
								}
							})
						})
						</script>

					</fieldset>
				</form>

			</div>

		</div>
	</div>


  </body>
</html>