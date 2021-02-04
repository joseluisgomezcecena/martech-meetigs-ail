<?php
require_once("classes/ActionUpdate.php");
$actionUpdate = new ActionUpdate();


if (isset($actionUpdate)) {
  if ($actionUpdate->errors) {
      foreach ($actionUpdate->errors as $error) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('Error!','$error','error');
          });
       </script>
       ";        }
  }
  if ($actionUpdate->messages) {
      foreach ($actionUpdate->messages as $message) {
        $p =   implode(',',$actionUpdate->project);
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            
            swal({
                title: 'Success!',
                text: '$message',
                type: 'success'
            }).then(function() {
                window.location = 'index.php?page=meeting_view&meeting_id=$p';
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
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();

?>

<h1 class="h3 mb-4 text-gray-800">Add An Update to Action <b><?php echo " ".$row['action_name']; ?></b></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?page=project_list">Back To Project List</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=project_view&project_id=<?php echo $row['action_project_id'] ?>">View Project</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add An Update to <?php echo $row['action_name']; ?></li>
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

                    <!--
                    <div class="form-group ">
                          <label>Completion percentage</label>
                          <select  name="percent" id="" class="form-control" required>
                            <option value="">Select</option>
                            <?php 
                            for($x = 0; $x <= 100; $x++):
                            ?>
                                <option value="<?php echo $x ?>"><?php echo $x ?>%</option>
                            <?php endfor; ?>
                          </select>
                    </div>
                    -->
                    
                    <div class="form-group">
                        <label>Update</label>
                        <textarea name="action_update" id="" class="form-control" rows="7" required></textarea>
                        <small>Date of update will be saved automatically once you click on Save Update.</small>
                    </div>

                                  
                    <div class="form-group right">
                        <button style="float: right;" id="edit_profile1" name="add_action_update" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
                            <i class="far fa-save fa-lg text-white-50"></i>&nbsp;&nbsp;Save Update
                        </button>
                    </div>

                </div>
                    
               
            </div>
        </div>

    </div>






</div>    
</form>          








