KansasBBQueue-
==============


http://bbqueue.cloudapp.net/

Setup
-----


To run the app you'll need to setup the following:
- Linux server with PHP
- cURL PHP extension enabled
- Sign up for a Twilio account, put your AccountSid and AuthToken in twilio-config.php
- Update twilio-sender.php to use your twilio phone number (this really should be moved into twilio-config)
- Setup a mySql server, fix config info in api.php
- Import the database structure from 'kansasbbqueue (1).sql' using command line / phpMyAdmin
- ???
- Profit 
