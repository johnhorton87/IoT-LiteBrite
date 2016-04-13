<?php

///////////////////////////////////////////////////////////////
// IoT Lite Brite - Database Preparation PHP File
//
// Written By J. Horton - 2/6/2016 v 1
//
// More info at http://johnventions.com/projects/lite-brite
//	Assumes the existance of an empty litebrite table
///////////////////////////////////////////////////////////////

//Set this up to connect to your own database
include("db_connect.php");

// Define the number of rows and columns you'll be working with
// This should match the number from the litebrite.php file

$rows = 10;
$cols = 15;

//Loop through the rows and columns, make an entry for each in the litebrite table
for ($i = 0; $i<$rows; $i++) {
	for ($j = 0; $j<$cols; $j++) {
		// For each row/col combination, create a record. Default to Black
		$insert = "INSERT INTO litebrite (row, col, r, g, b) VALUES (:row, :col, :r, :g, :b)";     
    			$params = array(
            			':row' => $i,
            			':col' => $j,
            			':r' => 0,
            			':g' => 0,
            			':b' => 0
        		);
    		stmt   = $db->prepare($insert);
    		$stmt->execute($params);
	}
}

?>