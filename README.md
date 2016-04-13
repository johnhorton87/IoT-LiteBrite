# IoT-LiteBrite
Internet of Things Lite Brite Drawing Canvas, connecting WS2812 LEDs to a web server with the Particle Photon

For more info, see: http://johnventions.com/projects/lite-brite

Many thanks to https://github.com/harrisonhjones/ for creating the PHP Particle Library

Files in the web-folder correspond to items that should be in the browser

Files in the hardware folder corrrespond to items that are embedded firmware

Files and Descriptions
  * Web/litebrite.php - User Interface for the web connected litebrite
  * Web/lb_create.php - PHP file to populate the database table
  * Web/lb_update.php - PHP file to update a sing pixel on the lite brite
  * Web/lb_json.php - PHP file that outputs the lite brite configuration as JSON
  * Web/lb_reset.php - PHP file that resets the lite brite database
  * Web/lb_js.js - Javascript File that controls the user interface
  * Web/lb_style.css - Style sheet for the web interface

Requirements
  * PHP Spark Library - https://github.com/harrisonhjones/phpParticle
  * db_connect.php - Create this file in the same directory to connect to your database
