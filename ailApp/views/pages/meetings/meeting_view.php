<?php
$stmt = $connection->prepare("SELECT * FROM meetings WHERE meeting_id = ?");
$stmt->bind_param("i", $_GET['meeting_id']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();



//check if user can see this

if($_SESSION['quatroapp_user_level'] == 0)
{
    $query_check = "SELECT * FROM meetings 
    LEFT JOIN departments ON meetings.meeting_department_id = departments.department_id 
    LEFT JOIN users  ON meetings.meeting_user_id = users.user_id
    LEFT JOIN meeting_attendees ON meeting_attendees.m_a_meeting_id = meetings.meeting_id 
    WHERE
    meeting_attendees.meeting_user_id = {$_SESSION['quatroapp_user_id']} AND meeting_id = {$_GET['meeting_id']} ";
    $run_check = mysqli_query($connection, $query_check);
    if(mysqli_num_rows($run_check) == 0)
    {
        die("<br>You dont have permission to access this meeting, or there are no actions for this meeting add actions first <a href='index.php'>Go Back</a>");
    }

    /*
    $query = "SELECT * FROM actions 
    LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id 
    LEFT JOIN departments ON actions.action_department = departments.department_id 
    LEFT JOIN action_responsible ON action_responsible.a_action_id = actions.action_id 
    WHERE 
    (meetings.meeting_id = {$row['meeting_id']} AND action_responsible.a_responsible_user = {$_SESSION['quatroapp_user_id']}) 
    OR (meetings.meeting_id = {$row['meeting_id']} AND meetings.meeting_owner = {$_SESSION['quatroapp_user_id']}) 
    ORDER BY actions.action_promise_date";
    
    $run_check = mysqli_query($connection, $query);
    if(mysqli_num_rows($run_check) == 0)
    {
      
        die("<br>You dont have permission to access this meeting, or there are no actions for this meeting add actions first <a href='index.php'>Go Back</a>");

    }
    */
}


?>
<h1 class="h3 mb-4 text-gray-800">Meeting: <b><?php echo $row['meeting_name'] ?></b></h1>

<div style="margin-bottom:15px;">
    <a  href="index.php?page=action_add&meeting_id=<?php echo $_GET['meeting_id']; ?>" id="add-newuser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Action</a>
    <a  href="index.php?page=report&meeting_id=<?php echo $_GET['meeting_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;&nbsp;Generate Report</a>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?page=meeting_list">Back To Meeting List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['meeting_name'] ?></li>
  </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Actions Overview</h6>
    </div>
        <div class="card-body">
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTableExcel" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th style="width: 100px;">Action</th>
                    <th>Problem / Observation</th>
                    <th>Department</th>
                    <th>Responsible</th>
                    <th style="width: 100px;">ECD</th>
                    <th>Time Status</th>
                    <th>Status</th>
                    <th>Updates / Comments</th>
                    <th style="width: 100px;" >Options</th>
                    <th style="width: 100px;">Updates</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                   
                    if($_SESSION['quatroapp_user_level'] == 0)
                    {   //solo ver acciones en las que participa
                        $query = "SELECT * FROM actions
                        LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id
                        LEFT JOIN action_responsible ON actions.action_id = action_responsible.a_action_id
                        LEFT JOIN users ON  action_responsible.a_responsible_user = users.user_id 
                        LEFT JOIN departments ON actions.action_department = departments.department_id 
                        WHERE meetings.meeting_id = {$_GET['meeting_id']} AND action_responsible.a_responsible_user = {$_SESSION['quatroapp_user_id']} ORDER BY actions.action_promise_date";    
                    }
                    else
                    {
                        $query = "SELECT * FROM actions
                        LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id
                        LEFT JOIN departments ON actions.action_department = departments.department_id 
                        WHERE meetings.meeting_id = {$_GET['meeting_id']} ORDER BY actions.action_promise_date";        
                    }
                    
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td><?php echo $row['action_id'];  ?></td>
                            <td><?php echo $row['action_name'];  ?></td>
                            <td style="text-align: justify;"><?php echo $row['action_description'];  ?></td>
                            <td><?php echo $row['department_name'];  ?></td>
                            <td>
                                <?php   
                                $query2 = "SELECT * FROM action_responsible 
                                LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id
                                WHERE a_action_id = {$row['action_id']}";
                                $result2 = mysqli_query($connection, $query2);
                                while($row2 = mysqli_fetch_array($result2)):
                                if($row2['a_responsible_main'] == 1)
                                {
                                    $icon = "<i class='fas fa-exclamation-circle text-danger'></i>";
                                }
                                else
                                {
                                    $icon = "";
                                }
                                ?>
                                    <a href="index.php?page=user_info&user_id=<?php echo $row2['user_id'] ?>"><?php echo $row2['user_name'] ?>&nbsp;&nbsp;<?php echo $icon ?></a><br>
                                <?php endwhile; ?>
                            </td>
                            <td>
                                <?php 
                                echo date('m-d-Y', strtotime($row['action_promise_date']));  
                                
                                $get_previous = "SELECT * FROM ecd_changes WHERE ecd_action_id = {$row['action_id']}";
                                $run_previous = mysqli_query($connection, $get_previous);
                                while($row_previous = mysqli_fetch_array($run_previous))
                                {
                                    echo "<br><del style='color:red;'>".date('m-d-Y', strtotime($row_previous['ecd_date']))."</del>";
                                }

                                ?>
                            </td>
                            <td>
                                <?php
                                    if($row['action_status'] == 0 && $row['action_promise_date'] <= date("Y-m-d"))
                                    {
                                        echo "<b style='color:red'>Late</b>";
                                    }   
                                    elseif($row['action_status'] == 0 && $row['action_promise_date'] > date("Y-m-d"))
                                    {
                                        echo "On time";
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                            if($row['action_complete']== 1)
                            {
                                echo "Completed";
                            }
                            else
                            {
                                echo "On Going";
                            }
                            ?>
                            </td>
                            <td>
                                <?php 
                                if(isset($row['action_id']))
                                {
                                    $qresponsible = "SELECT * FROM action_updates 
                                    LEFT JOIN users ON action_updates.a_update_user = users.user_id 
                                    WHERE a_update_action_id = {$row['action_id']}";
                                    $runqresponsible = mysqli_query($connection, $qresponsible);
                                    while($row_responsible = mysqli_fetch_array($runqresponsible))
                                    {
                                        echo "<b>".$row_responsible['user_name']." :</b>".$row_responsible['a_update_descr']."<br><br/>";
                                    }
                                }
                                else
                                {
                                    echo "N/A";
                                }
                                ?>
                            </td>
                            <td>
                                <a href='index.php?page=view_update&action_id=<?php echo $row['action_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='View action details' style='font-size: 20px; color:#b5b5b5' class='fas fa-eye options'></i></a>
                                <a href='index.php?page=action_edit&action_id=<?php echo $row['action_id']?>&meeting_id=<?php echo $_GET['meeting_id'] ?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Edit action' style='font-size: 20px; color:#b5b5b5' class='fa fa-edit options'></i></a>
                            </td>
                            <td>
                                <a href='index.php?page=action_add_update&action_id=<?php echo $row['action_id']?>&meeting_id=<?php echo $_GET['meeting_id'] ?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Add an update to this action' style='font-size: 20px; color:#b5b5b5' class='fas fa-plus-circle options'></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a href='index.php?page=action_add_file&action_id=<?php echo $row['action_id']?>&meeting_id=<?php echo $_GET['meeting_id'] ?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Add a file docx, xlsx, csv, pdf or image' style='font-size: 20px; color:#b5b5b5' class='fas fa-file-upload options'></i></a>
                                <!--
                                &nbsp;&nbsp;&nbsp;
                                <a href='index.php?page=action_progress&action_id=<?php echo $row['action_id']?>&meeting_id=<?php echo $_GET['meeting_id'] ?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Update status' style='font-size: 20px; color:#b5b5b5' class='fas fa-tasks options'></i></a>
                                -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Meeting Actions Completion Percentage</h6>
            </div>
            <div class="card-body">
                    
                    <div id="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
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
                    <th>Leader</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM actions
                    LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id 
                    LEFT JOIN departments ON actions.action_department = departments.department_id  
                    WHERE meetings.meeting_id = {$_GET['meeting_id']} AND action_end_date != '0000-00-00' AND action_complete = 1 ORDER BY actions.action_promise_date";

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
                                        if($row['action_promise_date'] >= $row['action_end_date'])
                                        {
                                            echo "<b style='color:green'>On Time! </b><br>";
                                        }
                                        else
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

            
