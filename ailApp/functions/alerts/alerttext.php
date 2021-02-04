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
if(mysqli_num_rows($result) > 0)
{


  while($row = mysqli_fetch_array($result))
  {
      echo 
      '
      <a  class="dropdown-item d-flex align-items-center" href="index.php?page=view_update&action_id='.$row['action_id'].'">
              <div class="mr-3">
                <div class="icon-circle bg-danger">
                  <i class="fas fa-exclamation text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">Late action! '.date_format(date_create($row['action_promise_date']), "m-d-Y") .'</div>
                <span class="font-weight-bold">'.$row['action_name'].'</span>
              </div>
      </a>
      ';


  }

}
else
{
  echo 
      '
      <a  class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3">
                <div class="icon-circle bg-success">
                  <i class="fas fa-clipboard-check text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">Nothing to show</div>
                <span class="font-weight-bold">No Late Actions</span>
              </div>
      </a>
      ';

}