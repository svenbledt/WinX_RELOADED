<?php
error_reporting(0);
session_start();
header('Content-Type: text/html; charset=UTF-8');

require('inc/include.php');
require('inc/templates/head.php');

$page =  $_GET['page'];
if (isset($page)) {
  $filename = "./_pages/" . $page . ".php";
  if (file_exists($filename)) {
    require("./_pages/" . $page . ".php");
  } else {
    require("./_pages/error.php");
  }
} else {
  require("./_pages/index.php");
}
require('inc/templates/footer.php');
