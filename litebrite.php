<html>
<head>
	<title>Internet of Things Lite Brite</title>

	<link rel="stylesheet" type="text/css" href="/lb_style.css">

	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type='text/javascript' src="/jscolor.js"></script>
	<script type='text/javascript' src='/lb_js.js'></script>

</head>

<body onLoad='initialRefresh()'>
	<div id='colorPicker'>
    		Select Color: <input class="jscolor {onFineChange:'update(this)'}" value="000000">
    		<form id='pixels' style='display:none;'>
        		<input type='text' name='row' id='row' value='0'>
        		<input type='text' name='col' id='col' value='0'>
        		<input type='text' name='r' id='r' value='0'>
        		<input type='text' name='g' id='g' value='0'>
        		<input type='text' name='b' id='b' value='0'>
    		</form>
	</div>

    	<div id='canvas'>

        <?php
		//Define the number of rows and columns you'd like
		//Make this match the rows and columns generated in your MySQL table

  		$rows = 10;
  		$cols = 15;

		//Loop through the rows to make the X*Y interface
  		for ($i = 0; $i<$rows; $i++) {
			echo "<div id='lb_row" . $i . "' class='lb_row'>";
    			for ($j = 0; $j < $cols; $j++) {
      				echo "<div id='lb_box" . $i . "_" . $j ."' class='lb_box' onClick='light(" . $i . "," . $j .")'></div>";
    			}
			echo "</div>";
  		}
  		?>
    	</div>

    	<div id='status'></div>

</body>

</html>