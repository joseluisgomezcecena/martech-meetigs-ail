<?php
define("DB_HOST", "localhost");
define("DB_NAME", "martech_ail_meetings");
define("DB_USER", "root");
define("DB_PASS", "");


$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$connection)
{
  die("Error on DB connection :(");
}
$connection->set_charset("utf8");


//require_once("functions/users/users.php");