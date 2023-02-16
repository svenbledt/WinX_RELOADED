<?php 
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('Europe/Berlin');

// check if session is defined for logged in user
$logged_in = $_SESSION['LOGGEDIN']??false;

// define host server variable
$host = $_SERVER['HTTP_HOST'];