<!DOCTYPE html>
<html lang="en">
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/bootstrap.min.css"></link>

    <link rel="stylesheet" href="css/jquery-ui.css"></link>

    <link rel="stylesheet" href="css/style.css"></link>


    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script type="text/javascript" src="js/jquery-ui.js"></script>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>

  </head>
  <body>
  <div class="container">

	<div class="row">

    <img id="logo" src="img/bbq.svg">

	  <div class="col-12 col-lg-8"><h1>Register</h1></div>


    <div class="col-12 col-lg-8">
      
      <form class="form-horizontal" action="query.php" method="post">
        <fieldset>
          <div class="form-group">
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
            <label class="col-2" for="phone">Phone number:</label>
            <div class="col-10">
              <input class="form-control" type="tel" id="phone" name="phone" placeholder="555-555-5555">
            </div>
          </div>

          <script>
            var startTime;
            var endTime;

            function slideTime(event, ui){
              console.log('hi');
              var val0 = $("#slider-range").slider("values", 0),
                val1 = $("#slider-range").slider("values", 1),
                minutes0 = parseInt(val0 % 60, 10),
                hours0 = parseInt(val0 / 60 % 24, 10),
                minutes1 = parseInt(val1 % 60, 10),
                hours1 = parseInt(val1 / 60 % 24, 10);
                
              startTime = getTime(hours0, minutes0);
              endTime = getTime(hours1, minutes1);
              $("#time").text(startTime + ' - ' + endTime);
            }
            function getTime(hours, minutes) {
              var time = null;
              minutes = minutes + "";
              if (hours < 12) {
                time = "AM";
              }
              else {
                time = "PM";
              }
              if (hours == 0) {
                hours = 12;
              }
              if (hours > 12) {
                hours = hours - 12;
              }
              if (minutes.length == 1) {
                minutes = "0" + minutes;
              }
              return hours + ":" + minutes + " " + time;
            }

            $(document).ready(function() {
              $("#slider-range").slider({
                range: true, min: 420, max: 1260, values: [900, 1020], step:5, slide: slideTime
                });

              $("#time").text("3:00 PM" + ' - ' + "5:00 PM");
            });

          </script>

          <div class="form-group">
            <label class="col-12" for="time-range">When do you plan to vote on election day?</label><br>
            <div id="slider-range" class="col-4"></div><br>
            <span id="time"></span>
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