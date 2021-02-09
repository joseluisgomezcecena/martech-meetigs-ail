<h1 class="h3 mb-4 text-gray-800">User Action Log</h1>

<div style="margin-bottom:15px;">
    <!-- 
    <a  href="index.php?page=project_add" id="add-newuser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Project</a>
       
    <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;&nbsp;Generate Report</a>
    -->
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">

            <div style="margin-bottom: 50px;" class="row">
                <div class="form-group col-lg-2">
                    <label>Start Date</label>
                    <input type="text" name="start_date" id="" class="form-control datepicker" required>
                </div>
                <div class="form-group col-lg-2">
                    <label>End Date</label>
                    <input type="text" name="end_date" id="" class="form-control datepicker" required>
                </div>
                <div class="form-group col-lg-4">
                    <button style="margin-top: 32px;" type="submit" name="search" id="" class="btn btn-primary" ><i class="fa fa-search"></i>&nbsp;&nbsp;Search...</button>
                </div>
            </div>

            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th style="text-align: center;">Transaction ID</th>
                    <th style="text-align: center;">User</th>
                    <th style="text-align: center;">User Action</th>
                    <th style="text-align: center;">Meeting</th>
                    <th style="text-align: center;">Action</th>
                    <th style="text-align: center;">Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                   
                    if(isset($_POST['search']))
                    {

                        if(empty($_POST['start_date'])|| empty($_POST['end_date']))
                        {
                            echo "Select a Date Range";    
                        }
                        elseif($_POST['start_date'] > $_POST['end_date'])
                        {
                            echo "Check your date range, your start date is after your end date";
                        }
                        elseif(
                                !empty($_POST['start_date']) 
                                && !empty($_POST['end_date'])
                                && $_POST['start_date'] < $_POST['end_date']
                        )
                        {

                    
                            $query = "SELECT * FROM user_actions 
                            LEFT JOIN departments ON meetings.meeting_department_id = departments.department_id 
                            LEFT JOIN users  ON meetings.meeting_user_id = users.user_id 
                            LEFT JOIN actions ON meetings.meeting_id = actions.action_meeting_id  
                            LEFT JOIN meeting_attendees ON meeting_attendees.m_a_meeting_id = meetings.meeting_id 
                            WHERE
                            meeting_attendees.meeting_user_id = {$_SESSION['quatroapp_user_id']} AND meeting_complete != 1";
                        

                            

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
                                    <td>
                                        <a href='index.php?page=meeting_report&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Generate Meeting Report' style='font-size: 28px; color:#03913a' class='far fa-file-excel options2'></i></a>
                                    </td>
                                    <td>
                                        <a href='index.php?page=report&meeting_id=<?php echo $row['meeting_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Generate Action Report' style='font-size: 28px; color:#03913a' class='far fa-file-excel options2'></i></a>
                                    </td>
                                </tr>
                    <?php
                        endwhile; 
                        }
                    }
                    ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>




