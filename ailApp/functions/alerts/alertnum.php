<?php
require_once("../../settings/db.php");
require_once("../../settings/settings.php");

session_start();

global $connection;

$today = date("Y-m-d");

$query = "SELECT * FROM action_responsible  
LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id
WHERE 
actions.action_complete = 0 AND action_responsible.a_responsible_user = {$_SESSION['quatroapp_user_id']} 
AND actions.action_promise_date <= '$today'
";

$result = mysqli_query($connection, $query);

$num = mysqli_num_rows($result);

echo $num;