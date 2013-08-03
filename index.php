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

    <style>
      form {
        margin-top: 30px;
        margin-bottom: 30px;
      }
    </style>    

  </head>
  <body>
  <div class="container">

	<div class="row">

	  <div class="col-12 col-lg-8">
      <h1>Election Day: 9.10.2013</h1>

        <h4>Send us your deets and we'll text you your wait time.</h4>
        <h4>Sit back, relax and get ready to vote.</h4>
      
      <form class="form-horizontal" action="query.php" method="post">
        <fieldset>
          <div class="form-group">
            <label class="col-2" for="street-num">Home address:</label>
            <div class="col-6">
              <input class="form-control" type="text" id="street-num" name="street-num" placeholder="218 16th Street">
            </div>
          </div>

          <div class="form-group">
            <label class="col-2" for="state">City:</label>
            <div class="col-6">
                <input class="form-control" type="Text" id="street-num" name="city" placeholder="New York City">
            </div>
          </div>


          <div class="form-group">
            <label class="col-2" for="state">State:</label>
            <div class="col-6">

              <?php

                  $states_arr = array('NY' => "New York");

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
            <label class="col-2" for="state">Zip Code:</label>
            <div class="col-2">
                <input class="form-control" type="text" id="zip" name="zip" placeholder="11211">
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
                range: true, min: 350, max: 1260, values: [900, 1020], step:5, slide: slideTime
                });

              $("#time").text("3:00 PM" + ' - ' + "5:00 PM");
            });

          </script>

          <div class="form-group">
            <label class="col-12" for="time-range">When do you want to vote?</label><br>
            <div id="slider-range" class="col-4"></div><br>
            <span id="time"></span>

            <input type="hidden" type="text" name="startTime" id="startTime" value="3:00 PM">
            <input type="hidden" type="text" name="endTime" id="endTime" value="5:00 PM">
          </div>

          <div class="form-group">
            <label class="col-12" class="help-block">Are you registered to vote?</label>
              <label class="checkbox-inline col-2">
                <input type="radio" name="notify" value="yes"> Yes </input>
              </label>
              <label class="checkbox-inline col-2">
                <input type="radio" name="notify" value="no"> No </input>
              </label>
              <label class="checkbox-inline col-3">
                <input type="radio" name="notify" value="idk"> I don't know </input>
              </label>
          </div>

          <button type="submit" class="btn btn-primary">Done</button>

        </fieldset>
        
      </form>
    </div>

	</div>

  </div>
</body>
</html>