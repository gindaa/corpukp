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
        <a href="training_support.php">Training Support</a>
      </li>
      <li class="breadcrumb-item active">Ubah Data Kegiatan</li>
    </ol>
    <?php
    $id = $_GET['id'];

    $querydata = "SELECT * FROM training_support WHERE ts_id ='$id'";

    $resdata = mysqli_query($con, $querydata);
    $datats = mysqli_fetch_array($resdata);
    ?>

    <form method="post" enctype="multipart/form-data">


      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $datats['ts_name']; ?>">
      </div>

      <div class="form-group">
        <label>No HP</label>
        <input type="text" class="form-control" name="hp" value="<?php echo $datats['ts_hp']; ?>">
      </div>

      <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" value="<?php echo $datats['ts_alamat']; ?>">
      </div>

      <div class="form-group">
        <img src="images/<?php echo $datats['ts_foto'] ?>" width="200">
      </div>

      <div class="form-group">
        <label>Foto</label>
        <input type="file" name="foto">
      </div>

      <input type="submit" class="btn btn-primary" name="ubah" value="Ubah Data">
    </form>

    <?php

    if (isset($_POST['ubah'])) {
      $namafoto=$_FILES['foto']['name'];
      $lokasifoto = $_FILES['foto']['tmp_name'];

      if (!empty($lokasifoto))
      {
        move_uploaded_file($lokasifoto, "images/$namafoto");
        $con->query("UPDATE training_support SET ts_name='$_POST[nama]', ts_hp='$_POST[hp]', ts_alamat='$_POST[alamat]', ts_foto='$namafoto' 
          WHERE ts_id='$id'");
      }
      else
      {
        $con->query("UPDATE training_support SET ts_name='$_POST[nama]', ts_hp='$_POST[hp]', ts_alamat='$_POST[alamat]' 
          WHERE ts_id='$id'");
      }
      echo "<script>alert('Data Telah Diubah');</script>";
      echo "<script>window.location = 'training_support.php';</script>";


    }

    ?>
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
