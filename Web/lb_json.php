<?php

///////////////////////////////////////////////////////////////
// IoT Lite Brite - LiteBrite OUTPUT PHP File
//
// Written By J. Horton - 2/6/2016 v 1
//
// More info at http://johnventions.com/projects/lite-brite
///////////////////////////////////////////////////////////////


//Connect to your db_connect file
require_once("db_connect.php");

//Query all of the rows and columns
$select = "SELECT row, col, r, g, b FROM litebrite";
    $stmt2 = $db->prepare($select);
    $stmt2->execute();
    $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    //Output the dataset in JSON for easy processing in the browser
    $json = json_encode($results);
    echo $json;


?>