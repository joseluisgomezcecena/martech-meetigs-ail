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
                window.location = 'index.php?page=project_list';
            });
          });
       </script>
       ";
      }
  }
}

$stmt = $connection->prepare("SELECT * FROM meetings WHERE meeting_id = ?");
$stmt->bind_param("i", $_GET['meeting_id']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row_data = $result->fetch_array();
$stmt->close();


?>

<h1 class="h3 mb-4 text-gray-800">Delete Meeting</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?page=project_list">Back To Meeting List</a></li>
    <li class="breadcrumb-item active" aria-current="page">Delete <?php echo $row_data['meeting_name'] ?></li>
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


                    

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> You are about to delete this meeting: <b><?php echo $row_data['meeting_name'] ?></b>, by doing so you all records of actions and responsabilities will be lost.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>




                    <div class="form-group">
                        <b>Delete:</b><?php echo $row_data['meeting_name'] ?> ?
                    </div>

                    
                    
                    <div class="form-group right">
                        
                        
                        <button style="float: right;" id="edit_profile1" name="delete_meeting" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ">
                            <i class="far fa-trash-alt fa-lg text-white-50"></i>&nbsp;&nbsp;Delete
                        </button>
                    </div>




                </div>
                    
               
            </div>
        </div>

    </div>






</div>    
</form>          








