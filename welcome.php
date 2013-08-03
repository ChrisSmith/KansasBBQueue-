<!doctype html>
<html>
  <head>

  <?php
  	
    $addressstring = $_POST["street-num"]." ".$_POST["street"]." ".$_POST["city"]." ".$_POST["state"];
    //var_dump($addressstring);
    ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
        //alert(el);
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
          normEl.appendChild(document.createTextNode('Polling place for ' + normalizedAddress + ': '));
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
    <div id="results"></div>

    <br>
    <?php
   // $googleapi = "https://www.googleapis.com/civicinfo/us_v1/elections?key=<AIzaSyB_BhJr3sTC0FK6iq1nF5fuEosbLWQkynA>";
    //$xml=simplexml_load_file($googleapi);
    //print_r($xml);
$jsonurl = "https://www.googleapis.com/civicinfo/us_v1/elections?key=AIzaSyB_BhJr3sTC0FK6iq1nF5fuEosbLWQkynA";
$json = json_decode(file_get_contents($jsonurl),true);
//print_r($json);

    ?>



  </body>
</html>