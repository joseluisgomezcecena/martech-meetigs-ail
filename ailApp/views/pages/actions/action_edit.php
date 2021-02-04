<?php
require_once("classes/Action.php");
$action = new Action();


if (isset($action)) {
    if ($action->errors) {
        foreach ($action->errors as $error) {
          echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
              swal('Error!','$error','error');
            });
         </script>
         ";        }
    }
    if ($action->messages) {
        foreach ($action->messages as $message) {
          $p =   implode($action->project);
          echo "
          <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
              
              swal({
                  title: 'Success!',
                  text: '$message',
                  type: 'success'
              }).then(function() {
                  window.location = 'index.php?page=project_view&project_id=$p';
              });
            });
         </script>
         ";
        }
    }
  }
$stmt = $connection->prepare("SELECT * FROM actions WHERE action_id = ?");
$stmt->bind_param("i", $_GET['action_id']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0)
{
    exit('No rows');
} 
    

$row_data = $result->fetch_array();
$stmt->close();


?>

<h1 class="h3 mb-4 text-gray-800">Edit Action <b><?php echo " ".$row_data['action_name']; ?></b></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?page=meeting_list">Back To Meeting List</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=meeting_view&meeting_id=<?php echo $row_data['action_meeting_id'] ?>">View <?php echo $row_data['action_name']; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit <?php echo " ".$row_data['action_name']; ?></li>
  </ol>
</nav>
<form method="POST" id="form-user" autocomplete="off" enctype="multipart/form-data">

<div class="row">
    <div class="col-lg-12 ">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default"></h6>
                        
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div id="profile-data" class="card-body">
                
            
            
                <div class="col-lg-8 offset-lg-2">


                    <div class="form-group">
                        <label>Action Name</label>
                        <input type="text" name="action_name" id="" class="form-control" value="<?php echo $row_data['action_name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Problem/Observation</label>
                        <textarea name="action_description" id="" class="form-control" rows="5" required><?php echo $row_data['action_description'] ?></textarea>
                    </div>

                    <div class="form-group ">
                          <label>Department</label>
                          <select  name="action_department" id="" class="form-control">
                            <option value="">Select</option>
                            <?php 
                            $query1 = "SELECT * FROM departments WHERE department_active = 1";
                            $run1 = mysqli_query($connection, $query1);
                            while($row1 = mysqli_fetch_array($run1)):
                            ?>
                                <option <?php if($row_data['action_department'] == $row1['department_id']){echo "selected";}else{echo "";} ?> value="<?php echo $row1['department_id'] ?>"><?php echo $row1['department_name'] ?></option>
                            <?php endwhile; ?>
                          </select>
                    </div>



                    <div class="form-group">
                        <label>Add Users</label>
                        <a href="index.php?page=user_add" target="_blank">Add User</a>
                        <i data-toggle='tooltip' data-placement='left' title='Sync / Refresh user list'  id="refreshList" class="fas fa-sync"></i>
                    </div>


                    <div id="userRefresh">                
                        <div class="form-group">
                            <label for="id_label_single">Responsible</label>
                            <select style="width: 100%;" class=" js-example-basic-multiple form-control" id="id_label_multiple" name="responsible[]" multiple="multiple" > 
                                <?php 
                                $query = "SELECT * FROM meeting_attendees 
                                LEFT JOIN users ON meeting_attendees.meeting_user_id = users.user_id 
                                WHERE m_a_meeting_id = {$row_data['action_meeting_id']}";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($result)):

                                    $qres = "SELECT * FROM action_responsible WHERE a_action_id = {$_GET['action_id']} AND a_responsible_user = {$row['meeting_user_id']}";
                                    $runq = mysqli_query($connection, $qres);
                                    

                                ?>
                                    <option <?php if(mysqli_num_rows($runq)){echo "selected";}else{echo"";} ?> value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Estimated Completion Date (ECD)</label>
                            <input type="text" name="ecd"  class="form-control datepicker" value="<?php echo $row_data['action_promise_date'] ?>" required>
                        </div>
                    </div>
                    





                    

                    
                                  
                    <div class="form-group right">
                        <button style="float: right;" id="edit_profile1" name="edit_action" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
                            <i class="far fa-save fa-lg text-white-50"></i>&nbsp;&nbsp;Save Action
                        </button>
                    </div>

                </div>
                    
               
            </div>
        </div>

    </div>






</div>    
</form>          








