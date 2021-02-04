<?php
require_once("classes/Area.php");
$area = new Area();


if (isset($area)) {
  if ($area->errors) {
      foreach ($area->errors as $error) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('Error!','$error','error');
          });
       </script>
       ";        }
  }
  if ($area->messages) {
      foreach ($area->messages as $message) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('$message');
          });
       </script>
       ";
      }
  }
}

?>

<h1 class="h3 mb-4 text-gray-800">Add Areas</h1>

<form method="POST" id="form-user" autocomplete="off" enctype="multipart/form-data">

<div class="row">
    <div class="col-lg-4">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Site Info</h6>
                        
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
                    
                    <div class="form-group">
                        <label for="id_label_single">Choose a site</label>
                        <select style="width: 100%;" class=" js-example-basic-single form-control" id="id_label_single" name="site_id" required>
                            <?php 
                            $query = "SELECT * FROM andon_site WHERE site_active = 1";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($result)):
                            ?>
                                <option value="<?php echo $row['site_id']; ?>"><?php echo $row['site_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Area Name</label>
                        <input type="text" name="area_name" id="" class="form-control" required>
                    </div>

                    
                    <div class="form-group ">
                        <button id="edit_profile1" name="add_area" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Area
                        </button>
                    </div>

               
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Registered Sites</h6>
                        
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
                <div style="margin-top:-20px;" class="table-responsive">
                <table  style="font-size: 14px; vertical-align:middle; " class="table  table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Site</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $query = "SELECT * FROM andon_area LEFT JOIN andon_site 
                        ON andon_area.site_id = andon_site.site_id  
                        WHERE area_active = 1";

                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_array($result)):
                        ?>
                            <tr>
                                <td><?php echo $row['site_name'] ?></td>
                                <td><?php echo $row['area_name'] ?></td>
                                <td>
                                    <a href="<?php echo $row['site_id'] ?>"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo $row['site_id'] ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div><!--card body end-->
        </div>

    </div>




</div>    
</form>          








