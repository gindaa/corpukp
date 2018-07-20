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
      <li class="breadcrumb-item active">Tambah Training Support</li>
    </ol>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="nama">
      </div>
      <div class="form-group">
        <label>No HP</label>
        <input type="text" class="form-control" name="hp">
      </div>  
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat">
      </div>
      
      <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
      </div>

      <button class="btn btn-primary" name="simpan">Simpan</button>
    </form>
    <?php 
    if (isset($_POST['simpan']))
    {
      $nama = $_FILES['foto']['name'];
      $lokasi = $_FILES['foto']['tmp_name'];
      move_uploaded_file($lokasi, "images/".$nama);
      $con->query("INSERT INTO training_support 
        (ts_name,ts_hp,ts_alamat,ts_foto)
        VALUES('$_POST[nama]','$_POST[hp]','$_POST[alamat]','$nama')");

      echo "<div class='alert alert-info'>Data Tersimpan</div>";
      
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

