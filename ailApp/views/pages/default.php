<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Home</h1>
</div>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">View Meeting List</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Meetings</li>
  </ol>
</nav>


<div  class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="index.php?page=meeting_list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View All Meetings</a>
</div>
  

<div class="row">
  

<?php 
  $query = "SELECT * FROM meetings WHERE meeting_user_id = {$_SESSION['quatroapp_user_id']}";
  $result = mysqli_query($connection, $query);
  while($row = mysqli_fetch_array($result)):
?>  
<div class="col-lg-3">
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['meeting_name'] ?>&nbsp;&nbsp;<i data-toggle='tooltip' data-placement='right' title="You this meetings organizer: <?php echo $row['meeting_name'] ?>" style="color: #000000;" class="fa fa-question-circle"></i></h6>
            </div>
            
            <div class="card-body">
              <!--card body-->
              <?php 
              $cont = 0;
              $query = "SELECT * FROM actions WHERE action_meeting_id = {$row['meeting_id']}";
              $run = mysqli_query($connection, $query);
              $total = mysqli_num_rows($run);
              while($rowc = mysqli_fetch_array($run))
              {
                  if($rowc['action_complete'] == 1)
                  {
                      $cont++;
                  }
              }
              if($total == 0 || $cont == 0)
              {
                  $percentage = 0;
              }
              else
              {
                  $percentage = ceil(($cont/$total)*100);
              }
              
              

              if($percentage <= 25)
              {
                  $bg = "bg-danger";
              }
              elseif($percentage > 25 && $percentage <= 75)
              {
                  $bg = "bg-warning";
              }
              elseif($percentage > 75 && $percentage <= 99)
              {
                  $bg = "bg-success";
              }
              else
              {
                  $bg = "bg-primary";
              }

              ?>
              <div data-toggle='tooltip' data-placement='top' title='<?php echo  $cont . " Of " . $total . " Tasks Completed"?>' class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $bg; ?>"  role="progressbar" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage ?>%"></div>
              </div>
              
              
              <br>
              
              <a href="index.php?page=meeting_view&meeting_id=<?php echo $row['meeting_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-block"><i class="fas fa-paper-plane fa-sm text-white-50"></i> Go To Meeting Data</a>
              <!--card body-->
            </div>
    </div>
</div>
<?php
  endwhile;
?>
</div>












<div>
<div class="cokl-lg-12">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">My Pending Actions</h6>
    </div>
        <div class="card-body">
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <th>Project</th>
                    <th>Team</th>
                    <th>Promise Date</th>
                    <th>Status</th>
                    <th>Complete</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT * FROM action_responsible 
                    LEFT JOIN actions ON action_responsible.a_action_id = actions.action_id
                    LEFT JOIN meetings ON actions.action_meeting_id = meetings.meeting_id 
                    WHERE a_responsible_user = {$_SESSION['quatroapp_user_id']} AND action_complete = 0";
                  
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td><?php echo $row['action_id'];  ?></td>
                            <td><?php echo $row['action_name'];  ?></td>
                            <td><?php echo $row['meeting_name'];  ?></td>
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
                            <td><?php echo date('m-d-Y', strtotime($row['action_promise_date']));  ?></td>
                            <td>
                                <?php
                                    if($row['action_status'] == 0 && $row['action_promise_date'] <= date("Y-m-d"))
                                    {
                                        echo "Late";
                                    }   
                                    elseif($row['action_status'] == 0 && $row['action_promise_date'] > date("Y-m-d"))
                                    {
                                        echo "On time";
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 

                            

                            if($row['action_complete'] == 1)
                            {
                                $bg = "bg-primary";
                                $text = "Completed";
                            }
                            elseif($row['action_complete'] == 0 && $row['action_promise_date'] < date("Y-m-d"))
                            {
                                $bg = "bg-danger";
                                $text = "Late";
                            }
                            elseif($row['action_complete'] == 0 && $row['action_promise_date'] > date("Y-m-d"))
                            {
                                $bg = "bg-success";
                                $text = "On Going";
                            }

                            ?>
                                <div data-toggle='tooltip' data-placement='left' title='<?php echo  $text ?>' class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $bg; ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                </div>
                            </td>
                            <td>
                                <a href='index.php?page=view_update&action_id=<?php echo $row['action_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Go to Action Details' style='font-size: 20px; color:#b5b5b5' class='fas fa-paper-plane options'></i></a>
                            </td>
                            
                        </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>
</div>



<div>
<div class="cokl-lg-12">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">My Pending Actions</h6>
    </div>
        <div class="card-body">
            <div id="dp"></div>
        </div>
</div>
</div>
</div>



<script type="text/javascript">
  var dp = new DayPilot.Gantt("dp");
  dp.startDate = "2021-01-01";
  dp.days = 365;
  dp.init();

  loadTasks();

  function loadTasks() {
    dp.tasks.load("functions/gantt/gantt_tasks.php");
  }

</script>
