<h1 class="h3 mb-4 text-gray-800">Meeting List</h1>

<div style="margin-bottom:15px;">
    <a  href="index.php?page=meeting_add" id="add-newuser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Project</a>
    <!--    
    <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;&nbsp;Generate Report</a>
    -->
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTableExcel" width="100%" cellspacing="0">
                <thead style="text-align:center;">
                <tr>
                    <th>ID</th>
                    <th>Meeting</th>
                    <th>Date</th>
                    <th>Department</th>
                    <th>Organizer</th>
                    <th>Participants</th>
                    <th>Actions</th>
                    <th>Complete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    

                    if($_SESSION['quatroapp_user_level'] >= 1)
                    {
                        $query = "SELECT * FROM meetings 
                        LEFT JOIN departments ON meetings.meeting_department_id = departments.department_id 
                        LEFT JOIN users as owner ON meetings.meeting_user_id = owner.user_id 
                        WHERE meeting_active = 1 ";
                    }
                    else
                    {
                        $query = "SELECT * FROM `projects` 
                        LEFT JOIN departments ON projects.meeting_department = departments.department_id  
                        LEFT JOIN actions ON projects.meeting_id = actions.action_meeting_id 
                        LEFT JOIN action_responsible ON actions.action_id = action_responsible.a_action_id
                        LEFT JOIN users as owner ON projects.meeting_owner = owner.user_id 
                        LEFT JOIN users as support ON projects.meeting_support = support.user_id  
                        WHERE meeting_id IN (SELECT action_meeting_id FROM actions) 
                        AND action_responsible.a_responsible_user = {$_SESSION['quatroapp_user_id']} 
                        AND meeting_active = 1 
                        AND meeting_status != 4";
                    }

                    

                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['meeting_id'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['meeting_name'];  ?></td>
                            <td style="text-align: center;"><?php echo date('m-d-Y', strtotime($row['meeting_date']));  ?></td>
                            <td style="text-align: center;"><?php echo $row['department_name'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['user_name'];  ?></td>
                            <td style="text-align: center;">
                                <?php
                                    $participants = "SELECT * FROM meeting_attendees 
                                    LEFT JOIN users ON meeting_attendees.meeting_user_id = users.user_id 
                                    WHERE m_a_meeting_id = {$row['meeting_id']}";  
                                    $run_participants = mysqli_query($connection, $participants);
                                    while($row_participants = mysqli_fetch_array($run_participants)):
                                ?>
                                    <?php echo $row_participants['user_name']; ?><br>
                                <?php 
                                    endwhile;
                                ?>
                            </td>

                            <!--
                            <td style="text-align: justify;"><?php echo $row['meeting_description'];  ?></td>
                            <td style="text-align: center;"><?php if($_SESSION['quatroapp_user_level']>= 1){echo $row['16'];}else{echo $row['34']; }  ?></td>
                            <td style="text-align: center;"><?php echo date('m-d-Y', strtotime($row['meeting_promise_date']));  ?></td>
                            <td style="text-align: center;">
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
                                <div data-toggle='tooltip' data-placement='left' title='<?php echo  $cont . " Of " . $total . " Tasks Completed"?>' class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $bg; ?>"  role="progressbar" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage ?>%"></div>
                                </div>
                                
                                <?php
                                    if($row['meeting_status'] == 0 && date("Y-m-d") >= $row['meeting_promise_date'])
                                    {
                                        echo "Late";
                                    }
                                    elseif($row['meeting_status'] == 0 && date("Y-m-d") < $row['meeting_promise_date'])
                                    {
                                        echo "On Time";
                                    }
                                    elseif($row['meeting_status'] == 1 && date("meeting_end_date") < $row['meeting_promise_date'])
                                    {
                                        echo "Finished On Time";
                                    }
                                    elseif($row['meeting_status'] == 1 && date("meeting_end_date") >= $row['meeting_promise_date'])
                                    {
                                        echo "Finished Late";
                                    }
                                    else
                                    {
                                        echo "N/A";
                                    }  
                                ?>
                            </td>
                            -->
                            <td>
                                <a href='index.php?page=meeting_view&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='View Meeting' style='font-size: 20px; color:#b5b5b5' class='far fa-eye options'></i></a>
                                <a href='index.php?page=meeting_edit&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Edit Meeting' style='font-size: 20px; color:#b5b5b5' class='far fa-edit options'></i></a>
                                <a href='index.php?page=meeting_delete&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Delete Meeting' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt options'></i></a>
                            </td>
                            <td>
                                <!--    
                                <a href='index.php?page=action_add&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Add a task to this project' style='font-size: 20px; color:#b5b5b5' class='fas fa-folder-plus options'></i></a>
                                -->
                                <a href='index.php?page=meeting_complete&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Mark as completed' style='font-size: 20px; color:#b5b5b5' class='fas fa-check options2'></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>




