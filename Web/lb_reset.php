<?php

///////////////////////////////////////////////////////////////
// IoT Lite Brite - LiteBrite RESET PHP File
//
// Written By J. Horton - 2/6/2016 v 1
//
// More info at http://johnventions.com/projects/lite-brite
///////////////////////////////////////////////////////////////

//connnect to your mySQL database
include("db_connect.php");


//Define the number of rows and columns, this should match your litebrite.php file
$rows = 10;
$cols = 15;


error_reporting(E_STRICT);

//Include the Spark Class and Config files
if((@include 'phpSpark.class.php') === false)  die("Unable to load phpSpark class");
if((@include 'phpSpark.config.php') === false)  die("Unable to load phpSpark configuration file");

// Grab a new instance of our phpSpark object
$spark = new phpSpark();

//Set up to debug as HTML if an error arises
$spark->setDebugType("HTML");

// Set the timeout to be pretty short (in case your core is offline)
$spark->setTimeout("5");

// Set our access token (set in the phpConfig.config.php file)
$spark->setAccessToken($accessToken);

//Call the reset function on our microcontroller
$spark->callFunction($deviceID, "resetStrip", "");
$result = $spark->getResult();

//If we get a success result
if($result['return_value'] == 1) {
	//Great, nothing further to do
      	//$spark->debug_r($spark->getResult());

} else {
    echo "Lite Brite is offline<br>";
    //$spark->debug("Error: " . $spark->getError());
    //$spark->debug("Error Source" . $spark->getErrorSource());
}

//Either way, lets reset this thing in our database, eh?
$update = "UPDATE litebrite SET r=0, g=0, b=0";     
    $stmt   = $db->prepare($update);
    $stmt->execute();

?>
