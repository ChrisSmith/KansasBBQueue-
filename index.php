<!DOCTYPE html>
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

	  <div class="col-12 col-lg-8"><h1>Register</h1></div>


    <div class="col-12 col-lg-8">
      
      <form class="form-horizontal" action="welcome.php" method="post">
        <fieldset>
          <div class="form-group">
            <label class="col-2" for="fname">First name:</label> 
            <div class="col-4">
              <input class="form-control" type="text" id="fname" name="fname" placeholder="Full name">
            </div>

            <label class="col-2" for="lname">Last name:</label> 
            <div class="col-4">
              <input class="form-control" type="text" id="lname" name="lname" placeholder="Last name">
            </div>
          </div>

          <div class="form-group">
            <label class="col-2" for="age">Age:</label>
            <div class="col-4">
              <input class="form-control" type="number" id="age" name="age" placeholder="Enter age">
            </div>
          </div>

          <div class="form-group">
            <label class="col-2" for="street-num">Street number:</label>
            <div class="col-10">
              <input class="form-control" type="tel" id="street-num" name="street-num" placeholder="1600">
            </div>
          </div>

          <div class="form-group">
            <label class="col-2" for="street">Street:</label>
            <div class="col-10">
              <input class="form-control" type="tel" id="street" name="street" placeholder="Pennsylvania Avenue">
            </div>
          </div>

          <div class="form-group">
            <label class="col-2" for="state">State:</label>
            <div class="col-10">

              <?php

                  $states_arr = array('KS'=>"Kansas");

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
            <label class="col-2" for="phone">Phone number:</label>
            <div class="col-10">
              <input class="form-control" type="tel" id="phone" name="phone" placeholder="555-555-5555">
            </div>
          </div>

          <div class="form-group">
            <p class="col-12" class="help-block">When do you plan to vote?</p>
            <label class="checkbox-inline col-2" for="date">Date:</label>
                <input type="date" class="form-control col-3" name="day">
              <label class="checkbox-inline col-2" for="start">Start time:</label>
                <input type="time" class="form-control col-4" name="start">
              <label class="checkbox-inline col-2" for="end">End time:</label>
                <input type="time" class="form-control col-4" name="start">

          </div>

          <div class="form-group">
            <p class="col-12" class="help-block">How should we update you?</p>
              <label class="checkbox-inline col-3">
                <input type="checkbox" name="notify" value="email"> E-mail </input>
              </label>
              <label class="checkbox-inline col-2">
                <input type="checkbox" name="notify" value="SMS"> SMS </input>
              </label>
              <label class="checkbox-inline col-2">
                <input type="checkbox" name="notify" value="push"> Push notification </input>
              </label>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

        </fieldset>
        
      </form>
    </div>

	</div>

  </div>
</body>
</html>