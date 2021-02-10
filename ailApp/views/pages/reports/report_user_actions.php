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
            <form method="POST">
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
            </form>
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

                        $start_date =  strtotime($_POST['start_date']);
                        $start_date = date('Y-m-d', $start_date);

                        
                        $end_date =  strtotime($_POST['end_date']);
                        $end_date = date('Y-m-d', $end_date);


                        if(empty($_POST['start_date'])|| empty($_POST['end_date']))
                        {
                            echo "Select a Date Range";    
                        }
                        elseif($start_date > $end_date)
                        {
                            echo "Check your date range, your start date is after your end date";
                        }
                        elseif(
                                !empty($_POST['start_date']) 
                                && !empty($_POST['end_date'])
                                && $start_date < $end_date
                        )
                        {

                            
                            $query = "SELECT * FROM user_actions  
                            LEFT JOIN users  ON user_actions.u_a_user_id = users.user_id 
                            LEFT JOIN actions ON user_actions.u_a_action_id = actions.action_id
                            LEFT JOIN meetings ON user_actions.u_a_meeting_id = meetings.meeting_id  
                            WHERE
                            user_actions.u_a_date_time BETWEEN '$start_date' AND '$end_date'";
                        

                            

                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($result)):
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row['user_action_id'];  ?></td>
                                    <td style="text-align: center;"><?php echo $row['user_name'];  ?></td>
                                    <td style="text-align: center;"><?php echo $row['u_a_description'];  ?></td>
                                    <td style="text-align: center;"><?php echo $row['meeting_name'];  ?></td>
                                    <td style="text-align: center;"><?php echo $row['action_name'];  ?></td>
                                    <td style="text-align: center;"><?php echo date('m-d-Y H:i:s', strtotime($row['u_a_date_time']));  ?></td>
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




