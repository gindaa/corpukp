<?php
session_start();
if(($_SESSION['login']==true) && ($_SESSION['username']!= '')){
include 'config.php';
?>  
<!DOCTYPE html>
<html lang="en">


<?php
head();
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Data Kelas</li>
    </ol>
    <!-- Icon Cards-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Data Kelas</div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
            $query = "SELECT room_id, room_name, capacity, room_count, building_id, building_name
            FROM classroom
            JOIN building USING(building_id)";
            $tampil = mysqli_query($con, $query);
            if (mysqli_num_rows($tampil)>0) {

              ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Gedung</th>
                    <th>Kapasitas</th>
                    <th>Terpakai</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Gedung</th>
                    <th>Kapasitas</th>
                    <th>Terpakai</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i=1; 
                  while ($data = mysqli_fetch_array($tampil)) {
                    ?>
                    <tr>
                      <td><?php echo "$i"; ?></td>
                      <td><?php echo $data['room_name']; ?></td>
                      <td><?php echo $data['building_name']; ?></td>
                      <td><?php echo $data['capacity']; ?></td>
                      <td><?php echo $data['room_count']; ?></td>
                    </tr>
                    <?php
                    $i++;
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
<?php
foot();
?>
</div>
</body>

</html>
<?php 
} 
else{
  echo "<script> alert('Login Terlebih Dahulu');  
  window.location = 'index.php';    
  </script>";
}
?>

