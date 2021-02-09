<?php
header('Content-Type: application/json');

require_once("../../settings/db.php");
session_start();

global $connection;
$per = 0;

$query = "SELECT COUNT(*) as cuenta FROM actions 
WHERE action_meeting_id = {$_GET['meeting_id']} AND action_complete = 0";

$result = mysqli_query($connection,$query);
$row  = mysqli_fetch_array($result); 


$query2 = "SELECT COUNT(*) as cuenta2 FROM actions 
WHERE action_meeting_id = {$_GET['meeting_id']} AND action_complete = 1";

$result2 = mysqli_query($connection,$query2);
$row2  = mysqli_fetch_array($result2); 


/*
$query2 = "SELECT * FROM actions 
WHERE action_meeting_id = {$_GET['meeting_id']} AND action_completed = 1";

$result2 = mysqli_query($connection,$query2);

while($row2 = mysqli_fetch_array($result2))
{
    $per += $row2['action_percent'];
}
*/


$data = array();
/*
$cuenta = $row['cuenta']*100;
$per = $per*100;

$completo = $per/$cuenta;
$faltante = 100 - $completo;

$data[0] = round($faltante);
$data[1] = round($completo);
*/

$data[0] = round($row['cuenta']);
$data[1] = round($row2['cuenta2']);

mysqli_close($connection);

echo json_encode($data);
?>