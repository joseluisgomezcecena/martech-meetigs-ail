<h1 class="h3 mb-4 text-gray-800">Meetings</h1>

<div style="margin-bottom:15px;">
   
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTableExcel" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Meeting</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Department</th>
                    <th style="text-align: center;">Problem/Observation</th>
                    <th style="text-align: center;">Action</th>
                    <th style="text-align: center;">Responsible</th>
                    <th style="text-align: center;">ECD</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Comment</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                   
                    
                    $query = "SELECT * FROM meetings
                    LEFT JOIN departments ON meetings.meeting_department_id = departments.department_id 
                    LEFT JOIN actions ON meetings.meeting_id = actions.action_meeting_id 
                    LEFT JOIN users as owner ON meetings.meeting_user_id = owner.user_id
                    WHERE meeting_id = {$_GET['meeting_id']}";
                                

                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['meeting_id'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['meeting_name'];  ?></td>
                            <td style="text-align: center;"><?php echo date('m-d-Y', strtotime($row['meeting_date']));  ?></td>
                            <td style="text-align: center;"><?php echo $row['department_name'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['action_description'];  ?></td>
                            <td><?php  echo $row['action_name'];?></td>
                            <td>
                                <?php
                                if(isset($row['action_id']))
                                {
                                    $qresponsible = "SELECT * FROM action_responsible 
                                    LEFT JOIN users ON action_responsible.a_responsible_user = users.user_id 
                                    WHERE a_action_id = {$row['action_id']}";
                                    $runqresponsible = mysqli_query($connection, $qresponsible);
                                    while($row_responsible = mysqli_fetch_array($runqresponsible))
                                    {
                                        echo $row_responsible['user_name']."<br>";
                                    }
                                }
                                else
                                {
                                    echo "N/A";
                                }
                                
                                ?>
                            </td>
                            <td><?php echo $row['action_promise_date'] ?></td>
                            <td><?php if($row['action_complete'] == 1){echo "Completed";}else{echo "OnGoing";} ?></td>
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
                                        echo "<b>".$row_responsible['user_name']." :</b>".$row_responsible['a_update_descr']."<br>";
                                    }
                                }
                                else
                                {
                                    echo "N/A";
                                }
                                ?>
                            </td>
                            
                        </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>




