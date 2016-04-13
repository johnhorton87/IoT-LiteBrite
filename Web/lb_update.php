<?php

///////////////////////////////////////////////////////////////
// IoT Lite Brite - LiteBrite Update PHP File
//
// Written By J. Horton - 2/6/2016 v 1
//
// More info at http://johnventions.com/projects/lite-brite
///////////////////////////////////////////////////////////////

//Prepare headers for JSON output
header('Content-Type: application/json');

//Connect to your particular 
include("db_connect.php");


//Concatenate the command of row, col and R/G/B
//We'll be sending it as a commma separated string to the microcontroller
$command =  $_POST['row'] . ",";
$command .= $_POST['col'] . ",";
$command .= $_POST['r'] . ",";
$command .= $_POST['g'] . ",";
$command .= $_POST['b'] . ",";


error_reporting(E_STRICT);

// Include the Particle Class and Config files
// For more info, please see https://github.com/harrisonhjones/phpParticle

if((@include 'phpSpark.class.php') === false)  die("Unable to load phpSpark class");
if((@include 'phpSpark.config.php') === false)  die("Unable to load phpSpark configuration file");


// Create a Spark Object for connecting to the microcontroller
$spark = new phpSpark();

// Set the timeout to be pretty short (in case your core is offline)
$spark->setTimeout("2");

// Set our access token (set in the phpConfig.config.php file)
$spark->setAccessToken($accessToken);

// Set the debug calls to display in HTML
$spark->setDebugType("HTML");

//Call the LightBright function on the microcontroller and get the result
$spark->callFunction($deviceID, "LightBright", $command);
$result = $spark->getResult();

//Verify that the function succeeded (returns 1)
if($result['return_value'] == 1) {

        //Update the row and column in the database to the new color  
        $update = "UPDATE litebrite SET r=:r, g=:g, b=:b WHERE (row=:row and col=:col)";
        $params = array(
                ':r' => (int)$_POST['r'],
                ':g' => (int)$_POST['g'],
                ':b' => (int)$_POST['b'],
                ':row' => (int)$_POST['row'],
                ':col' => (int)$_POST['col']
            );
        
	// Send the database query
        $stmt   = $db->prepare($update);
        $stmt->execute($params);
        
    //Download all of the rows and columns in the database and return them to the users
    include "lb_json.php";

} else {
     // If the microcontroller does not return a success, output a failure notice
     echo "{'status':'failure'}";
   }
?>