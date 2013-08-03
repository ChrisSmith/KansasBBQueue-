<html lang="en">
        <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="css/bootstrap.min.css"></link>
                <link rel="stylesheet" href="css/nv.d3.css"></link>
                <link rel="stylesheet" href="css/style.css"></link>

                <style>
                        #map {
                                height: 200px;
                                margin: 10px;
                        }
                </style>

                <script type="text/javascript" src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/bootstrap.min.js"></script>

                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

                <?php $addressstring = $_POST["street-num"]." ".$_POST["street"]." ".$_POST["city"]." ".$_POST["state"]; ?>

                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script type="text/javascript" src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
                <script type="text/javascript" src="js/nv.d3.min.js" charset="utf-8"></script>
                <script type="text/javascript" src="js/viz.js"></script>
                <script language="javascript">
                function post(dictionary, url, method) {
                method = method || "post"; // post (set to default) or get

                // Create the form object
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", url);

                // For each key-value pair
                for (key in dictionary) {
                    alert('key: ' + key + ', value:' + dictionary[key]); // debug
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden"); // 'hidden' is the less annoying html data control
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", dictionary[key]);
                    form.appendChild(hiddenField); // append the newly created control to the form
                }

                document.body.appendChild(form); // inject the form object into the body section
                form.submit();
                }

                var myDictionary = [];
                //myDictionary["electionid"] = "<?php echo $_POST['electionid']; ?>";
                myDictionary["address"] = "<?php echo $addressstring; ?>";
                myDictionary['address'] = '321 W. 54th St, New York NY'

                address_bits = myDictionary['address'].split(' ');
                var query_string = '';

                for (var i=0 ; i<address_bits.length; i++) {
                        if (i==address_bits.length-1) {
                                query_string = query_string + address_bits[i];
                        }
                        else {
                                query_string = query_string + address_bits[i] + '+';
                        }
                }
                var base = 'http://maps.googleapis.com/maps/api/geocode/json?address=';
                var tail = '&sensor=true';

                var geocode_url = base+query_string+tail;

                $(document).ready(function(){
                        var map,
                        geocoder = new google.maps.Geocoder(),
                marker,
                latlng,
                myOptions = {
                      zoom: 13,
                      center: latlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                        // locate address
                        geocoder.geocode( { 'address': myDictionary['address']}, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        latlng = new google.maps.LatLng(results[0].geometry.location.Qa, results[0].geometry.location.Ra),
                        marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                      } else {
                        alert("Geocode was not successful for the following reason: " + status);
                      }
                    });

                    map = new google.maps.Map(document.getElementById('map'), myOptions);

                });


                /**
                   * Build and execute request to look up voter info for provided address.
                   * @param {string} address Address for which to fetch voter info.
                   * @param {function(Object)} callback Function which takes the
                   *     response object as a parameter.
                   */
                   function lookup(address, callback) {
                   /**
                     * Election ID for which to fetch voter info.
                     * @type {number}
                     */
                    var electionId = 2000;

                    /**
                     * Request object for given parameters.
                     * @type {gapi.client.HttpRequest}
                     */
                    var req = gapi.client.request({
                        'path' : '/civicinfo/us_v1/voterinfo/' + electionId + '/lookup',
                        'method' : 'POST', // Required. The API does not allow GET requests.
                        'body' : {'address' : address}
                    });
                   req.execute(callback);
                  }

                  /**
                   * Render results in the DOM.
                   * @param {Object} response Response object returned by the API.
                   * @param {Object} rawResponse Raw response from the API.
                   */
                  function renderResults(response, rawResponse) {
                    var el = document.getElementById('results');
                    if (!response || response.error) {
                      el.appendChild(document.createTextNode(
                          'Error while trying to fetch polling place'));
                      return;
                    }
                    var normalizedAddress = response.normalizedInput.line1 + ' ' +
                        response.normalizedInput.city + ', ' +
                        response.normalizedInput.state + ' ' +
                        response.normalizedInput.zip;
                    if (response.pollingLocations.length > 0) {
                      var pollingLocation = response.pollingLocations[0].address;
                      var pollingAddress = pollingLocation.locationName + ', ' +
                          pollingLocation.line1 + ' ' +
                          pollingLocation.city + ', ' +
                          pollingLocation.state + ' ' +
                          pollingLocation.zip;
                      var normEl = document.createElement('strong');
                      normEl.appendChild(document.createTextNode(
                          'Your polling place is: '));
                      el.appendChild(normEl);
                      el.appendChild(document.createTextNode(pollingAddress));
                    } else {
                      el.appendChild(document.createTextNode(
                          'Could not find polling place for ' + normalizedAddress));
                    }
                  }

                  /**
                   * Initialize the API client and make a request.
                   */
                  function load() {
                    gapi.client.setApiKey('AIzaSyB_BhJr3sTC0FK6iq1nF5fuEosbLWQkynA');
                    lookup(myDictionary["address"], renderResults);
                  }
                </script>
                <script src="https://apis.google.com/js/client.js?onload=load"></script>

        </head>
        <body>

        <div class="container">
                <div class="row">

                        <div class="col-12"><h1>Your Polling Place:</h1></div>
                </div>

        <div class="row">

                <div class="col-12" id="results"></div>

                        <?php
                                $jsonurl = "https://www.googleapis.com/civicinfo/us_v1/elections?key=AIzaSyB_BhJr3sTC0FK6iq1nF5fuEosbLWQkynA";
                                $json = json_decode(file_get_contents($jsonurl),true);
                    ?>

                </div>
                <div class='col-12' id="map"></div>
                <div class="col-12"><h1>What's your wait?</h1></div>
                <div class='col-12' id="chart"><svg></svg></div>

        </div>


  </body>
</html>
