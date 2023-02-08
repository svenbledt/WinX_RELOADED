<?php 
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('Europe/Berlin');

$logged_in = $_SESSION['LOGGEDIN']??false;