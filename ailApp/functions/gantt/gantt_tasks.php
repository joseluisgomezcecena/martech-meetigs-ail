<?php
require_once("../../settings/db.php");
require_once("../../settings/settings.php");

session_start();

global $connection;

$today = date("Y-m-d");

/*
$stmt = $db->prepare('SELECT * FROM task');
$stmt->execute();
$items = $stmt->fetchAll();    
*/

$query = "SELECT * FROM action_responsible 
LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id
LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id 
WHERE a_responsible_user = {$_SESSION['quatroapp_user_id']} AND action_complete = 0";

$run = mysqli_query($connection, $query);
class Task {}
$result = array();

while($items = mysqli_fetch_assoc($run))
{
    $r = new Task();

    $result[] = array( 
        "id"=>$items['action_id'],
        "text"=>$items['action_name'],
        "start"=>$items['meeting_date'],
        "end"=>$items['action_promise_date']
    );
}
//echo($items);

/*

class Task {}

$result = array();

foreach($items as $item) {
  $r = new Task();
  
  
  // rows
  $r->id = $item[1];
  $r->text = $item[9];
  $r->start = $item[12];
  $r->end = $item[13];

  
  
  $result[] = $r;
}
/*
echo " R : <pre>";
var_dump($result);
echo "</pre>";
*/
header('Content-Type: application/json');
echo json_encode($result);