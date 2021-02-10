<?php
header('Content-Type: application/json');

require_once("../../settings/db.php");
date_default_timezone_set("America/Tijuana");

session_start();

global $connection;
$today = date("Y-m-d");

//tarde
$query = "SELECT COUNT(*) as cuenta FROM action_responsible 
LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id 
LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id 
WHERE action_responsible.a_responsible_user = {$_GET['user']} AND actions.action_promise_date < '$today';";

$result = mysqli_query($connection,$query);
$row  = mysqli_fetch_array($result); 

//a tiempo
$query2 = "SELECT COUNT(*) as cuenta2 FROM action_responsible 
LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id 
LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id 
WHERE action_responsible.a_responsible_user = {$_GET['user']} AND actions.action_promise_date >= '$today';";

$result2 = mysqli_query($connection,$query2);
$row2  = mysqli_fetch_array($result2); 



$data = array();

$data[0] = round($row['cuenta']);
$data[1] = round($row2['cuenta2']);

mysqli_close($connection);

echo json_encode($data);
?>