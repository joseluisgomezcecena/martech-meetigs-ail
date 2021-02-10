<?php
$stmt = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_GET['user']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();






?>
<h1 class="h3 mb-4 text-gray-800">User: <b><?php echo $row['user_name'] ?></b></h1>
<!--
<div style="margin-bottom:15px;">
    <a  href="index.php?page=action_add&meeting_id=<?php echo $_GET['meeting_id']; ?>" id="add-newuser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Action</a>
    <a  href="index.php?page=report&meeting_id=<?php echo $_GET['meeting_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;&nbsp;Generate Report</a>
</div>
-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Back To Home</a></li>
  </ol>
</nav>





<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Completed On Time vs Late</h6>
            </div>
            <div class="card-body">
                    
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="example1" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Action</th>
                    <th>Result</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    /*
                    $query = "SELECT * FROM actions
                    LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id 
                    LEFT JOIN departments ON actions.action_department = departments.department_id  
                    WHERE meetings.meeting_id = {$_GET['meeting_id']} AND action_end_date != '0000-00-00' AND action_complete = 1 ORDER BY actions.action_promise_date";
                    */

                    $query = "SELECT * FROM action_responsible 
                    LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id 
                    LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id 
                    WHERE action_responsible.a_responsible_user = {$_GET['user']} ORDER BY a_responsible_date  
                    ";

                    $result = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_array($result)):

                        $get_previous2 = "SELECT * FROM ecd_changes WHERE ecd_action_id = {$row['action_id']} ORDER BY ecd_id DESC LIMIT 1";
                        $run_previous2 = mysqli_query($connection, $get_previous2);
                        if(mysqli_num_rows($run_previous2)> 0)
                        {
                            $row_dates = mysqli_fetch_array($run_previous2);
                            //$previous_date = $row_dates['ecd_date'];
                            $text  = "Original: <del style='color:red;'>".date('m-d-Y', strtotime($row_dates['ecd_date']))."</del>";
                            $text2 = "Finished Late";
                        }
                        else
                        {
                            $text = "";
                        }                    
                    ?>
                    
                        <tr>
                            <td><?php echo $row['action_name']; ?></td>
                            <td>
                                <?php
                                    if(mysqli_num_rows($run_previous2)> 0)
                                    {
                                        echo $text2."<br>";
                                        echo $text."<br>";
                                        echo "Finished: ".date('m-d-Y', strtotime($row['action_end_date']));
                                    }
                                    else
                                    {
                                        if($row['action_complete'] == 0 && $row['action_promise_date'] > date("Y-m-d"))
                                        {
                                            echo "<b style='color:green'>On Going & On Time </b><br>";
                                        }
                                        elseif($row['action_complete'] == 0 && $row['action_promise_date'] < date("Y-m-d"))
                                        {
                                            echo "<b style='color:red'>On Going & Late </b><br>";
                                        }   
                                        elseif($row['action_complete'] == 1 && $row['action_promise_date'] >= $row['action_end_date'])
                                        {
                                            echo "<b style='color:green'>On Time! </b><br>";
                                        }
                                        elseif($row['action_complete'] == 1 && $row['action_promise_date'] <= $row['action_end_date'])
                                        {
                                            echo "<b style='color:red'>Late</b><br>";
                                            $dlate = round(strtotime($row['action_end_date']) - strtotime($row['action_promise_date']));
                                            echo $dlate / (60 * 60 * 24) . " Day(s)";
                                        }
                                    }
                                    
                                    
                                ?>
                            </td>
                            <td>
                                <?php
                                $query2 = "SELECT * FROM action_responsible 
                                LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id
                                WHERE a_action_id = {$row['action_id']}";
                                $result2 = mysqli_query($connection, $query2);
                                while($row2 = mysqli_fetch_array($result2)):
                                ?>
                                <img class='img-fluid user-img rounded-circle' src="<?php echo $row2['user_image'] ?>">&nbsp;&nbsp;<?php echo $row2['user_name'] ?><br>
                                <?php endwhile; ?>
                            </td>
                        </tr>
                    
                    <?php endwhile; ?>
                </tbody> 

            </div>
        </div>
    </div>
</div>    

            
