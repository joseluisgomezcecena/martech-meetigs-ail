<?php
require_once("classes/Meeting.php");
$meeting = new Meeting();


if (isset($meeting)) {
  if ($meeting->errors) {
      foreach ($meeting->errors as $error) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('Error!','$error','error');
          });
       </script>
       ";        }
  }
  if ($meeting->messages) {
      foreach ($meeting->messages as $message) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            
            swal({
                title: 'Success!',
                text: '$message',
                type: 'success'
            }).then(function() {
                window.location = 'index.php?page=meeting_list';
            });
          });
       </script>
       ";
      }
  }
}

?>

<h1 class="h3 mb-4 text-gray-800">Add A Meeting</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?page=project_list">Back To Meeting List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add A Metting</li>
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
                        <a class="dropdown-item" href="index.php?page=project_list">Go to meeting list</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php">Go to dashboard</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div id="profile-data" class="card-body">
                
            
            
                <div class="col-lg-8 offset-lg-2">

                    <div class="form-group">
                        <label>Meeting Name</label>
                        <input type="text" name="meeting_name" id="" class="form-control" value="<?php if(isset($_POST['meeting_name'])){echo $_POST['meeting_name'];}else{echo '';} ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Meeting Description</label>
                        <textarea name="meeting_description"  class="form-control" rows="5" required><?php if(isset($_POST['meeting_description'])){echo $_POST['meeting_description'];}else{echo '';} ?></textarea>
                    </div>

                    <div class="form-group ">
                          <label>Department</label>
                          <select  name="meeting_department" id="" class="form-control">
                            <option value="">Select</option>
                            <?php 
                            $query1 = "SELECT * FROM departments WHERE department_active = 1";
                            $run1 = mysqli_query($connection, $query1);
                            while($row1 = mysqli_fetch_array($run1)):
                            ?>
                                <option <?php if(isset($_POST['meeting_department']) && $_POST['meeting_department'] == $row1['department_id']){echo "selected";}else{echo "";} ?> value="<?php echo $row1['department_id'] ?>"><?php echo $row1['department_name'] ?></option>
                            <?php endwhile; ?>
                          </select>
                    </div>


                    <div class="form-group">
                        <label>Add Users</label>
                        <a href="index.php?page=user_add" target="_blank">Add User</a>
                        <i data-toggle='tooltip' data-placement='left' title='Sync / Refresh user list' id="refreshList" class="fas fa-sync"></i>
                    </div>

                    <div id="userRefresh">                
                        <div class="form-group">
                            <label for="id_label_single">Meeting Organizer</label>
                            <select style="width: 100%;" class=" js-example-basic-single form-control" id="id_label_single" name="meeting_user_id" required>
                                <?php 
                                $query = "SELECT * FROM users WHERE user_active = 1";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($result)):
                                ?>
                                    <option  <?php if(isset($_POST['meeting_user_id']) && $_POST['meeting_user_id'] == $row['user_id']){echo "selected";}else{echo "";} ?>  <?php if($row['user_id'] == $_SESSION['quatroapp_user_id']){echo "selected";}else{echo "";} ?> value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_label_single">Meeting Atendees</label>
                            <select style="width: 100%;" class=" js-example-basic-multiple form-control" id="id_label_multiple" name="responsible[]" multiple="multiple" > 
                                <?php 
                                $sel = '';
                                $query = "SELECT * FROM users WHERE user_active = 1";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($result)):

                                  
                                ?>
                                    <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="form-group col-lg-6">
                            <label>Meeting Date</label>
                            <input type="text" name="meeting_date" id="meeting_date" class="form-control datepicker" value="<?php if(isset($_POST['meeting_date'])){echo $_POST['meeting_date'];}else{echo '';} ?>" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <p>Today</p>
                            <label class="switch1 ">
                            <input id="meeting_today" name="date_today" type="checkbox" class="primary" >
                            <span class="slider1 round"></span>
                            </label>
                        </div>

                    </div>
                    <!--
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Project Phases</label>
                            <div id="inputFormRow">
                                <div class="input-group mb-3">
                                    <input type="text" name="phase[]" class="form-control m-input" placeholder="Enter Phase" autocomplete="off">
                                    <div class="input-group-append">                
                                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div id="newRow"></div>
                            <button id="addRow" type="button" class="btn btn-dark">Add Phase</button>
                        </div>
                    </div>
                   -->
                    
                    <div class="form-group right">
                        
                        <button style="float: right;" id="edit_profile1" name="add_meeting_continue" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
                            <i class="far fa-save fa-lg text-white-50"></i>&nbsp;&nbsp;Save Meeting and Add Actions
                        </button>
                        <button style="float: left;" id="edit_profile1" name="add_meeting" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ">
                            <i class="far fa-save fa-lg text-white-50"></i>&nbsp;&nbsp;Save Meeting and Exit
                        </button>
                    </div>




                </div>
                    
               
            </div>
        </div>

    </div>






</div>    
</form>          








