<h1 class="h3 mb-4 text-gray-800">Projects</h1>

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
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table  order-column " id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Department</th>
                    <th>Organizer</th>
                    <th>Start</th>
                    <th>Status</th>
                    <th>Complete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    /* 
                    $query = "SELECT * FROM projects 
                    LEFT JOIN departments ON projects.project_department = departments.department_id 
                    LEFT JOIN users ON projects.project_owner = users.user_id
                    LEFT JOIN users ON projects.project_support = users.user_id 
                    WHERE project_active = 1 AND project_status != 4";


                    
                    */

                    if($_SESSION['quatroapp_user_level'] >= 1)
                    {
                        echo $query = "SELECT * FROM meetings
                         LEFT JOIN departments ON meetings.meeting_department_id = departments.department_id 
                         LEFT JOIN actions ON meetings.meeting_id = actions.action_meeting_id 
                         LEFT JOIN users as owner ON meetings.meeting_user_id = owner.user_id
                         WHERE meeting_active = 1 AND meeting_complete != 1";
                    }
                    else
                    {
                        $query = "SELECT * FROM `projects` 
                        LEFT JOIN departments ON projects.project_department = departments.department_id  
                        LEFT JOIN actions ON projects.project_id = actions.action_project_id 
                        LEFT JOIN action_responsible ON actions.action_id = action_responsible.a_action_id
                        LEFT JOIN users as owner ON projects.project_owner = owner.user_id 
                        LEFT JOIN users as support ON projects.project_support = support.user_id  
                        WHERE project_id IN (SELECT action_project_id FROM actions) 
                        AND action_responsible.a_responsible_user = {$_SESSION['quatroapp_user_id']} 
                        AND project_active = 1 
                        AND project_status != 4";
                    }

                    

                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['meeting_id'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['meeting_name'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['department_name'];  ?></td>
                            <td style="text-align: center;"><?php echo $row['user_name'];  ?></td>
                            <td style="text-align: center;"><?php echo date('m-d-Y', strtotime($row['meeting_date']));  ?></td>
                            <td>
                            <?php  
                            echo $row['action_name'];
                            ?>
                            </td>
                            
                            <td>
                                <!--    
                                <a href='index.php?page=action_add&project_id=<?php echo $row['project_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Add a task to this project' style='font-size: 20px; color:#b5b5b5' class='fas fa-folder-plus options'></i></a>
                                -->
                                <a href='index.php?page=report&project_id=<?php echo $row['project_id']?>'  class=''  data-cat-name='{$row['user_name']}' data-cat-id='{$row['user_id']}'><i data-toggle='tooltip' data-placement='left' title='Generate Report' style='font-size: 28px; color:#03913a' class='far fa-file-excel options2'></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>




