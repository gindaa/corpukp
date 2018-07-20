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
      <li class="breadcrumb-item active">Training Support</li>
    </ol>
    <!-- Icon Cards-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Data Training Support</div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
            $query = "SELECT * FROM training_support";
            $tampil = mysqli_query($con, $query);
            if (mysqli_num_rows($tampil)>0) {

              ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i=1; 
                  while ($data = mysqli_fetch_array($tampil)) {

                    ?>
                    <tr>
                      <td><?php echo "$i"; ?></td>
                      <td><?php echo $data['ts_name']; ?></td>
                      <td><?php echo $data['ts_hp']; ?></td>
                      <td><?php echo $data['ts_alamat']; ?></td>
                      <td><img src="images/<?php echo $data['ts_foto']; ?>" width="100" ></td>
                      <td><a href="ubahts.php?id=<?php echo $data['ts_id']; ?>" class="btn btn-info btn-xs">Ubah</a>
                        <a href="hapus_ts.php?id=<?php echo $data['ts_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apa Anda Yakin Ingin Menghapus Data ?')">Hapus
                        </a></td>
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
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>Copyright © Your Website 2018</small>
      </div>
    </div>
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
