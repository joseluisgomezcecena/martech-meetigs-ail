<h1 class="h3 mb-4 text-gray-800">Areas</h1>

<div style="margin-bottom:15px;">
    <a  href="index.php?page=site_add" id="add-newuser" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add Site</a>
    <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;&nbsp;Generate Report</a>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">
            <div style="margin-top:-20px;" class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle; " class="table table-hover" id="dataTableExcel" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Area id</th>
                    <th>Name</th>
                    <th>Site</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT * FROM andon_area LEFT JOIN andon_site ON andon_area.site_id = andon_site.site_id 
                    WHERE site_active = 1 AND area_active = 1";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>
                        <tr>
                            <td><?php echo $row['area_id'] ?></td>
                            <td><?php echo $row['area_name'] ?></td>
                            <td><?php echo $row['site_name'] ?></td>
                            <td>
                                <a href="index.php?page=area_edit&area_id=<?php echo $row['area_id'] ?>"><i style="font-size: 20px; color:#b5b5b5" class="fa fa-edit"></i></a>
                                &nbsp;&nbsp;
                                <a href="index.php?page=area_delete&area_id=<?php echo $row['area_id'] ?>"><i style="font-size: 20px; color:#b5b5b5" class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




