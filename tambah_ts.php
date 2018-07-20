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
          <label>Foto (optional)</label>
          <br>
          <input type="file" name="foto" accept=".jpg, .jpeg, .tiff, .gif, .bmp, .png">
        </div>

        <br>
        <input type="submit" class="btn btn-primary" name="tambah" value="Tambah Training Support">
      </form>

      <?php

      if (isset($_POST['tambah'])) {

        $nama = $_POST['nama'];
        $hp = $_POST['hp'];
        $alamat = $_POST['alamat'];

        if($_FILES['foto']['name']){
          $foto = $_FILES['foto']['name'];
          $tmp = $_FILES["foto"]['tmp_name'];

          $fotobaru = date('dmYHis').$foto;
          $path = "images/".$fotobaru;

          //Proses upload
          if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak  
          // Proses  simpan ke Database  
          $query = "INSERT INTO training_support VALUES(null, '".$nama."', '".$hp."', '".$alamat."', '".$fotobaru."')";  
          $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel 
          if($sql){ // Cek jika proses simpan ke database sukses atau tidak    // Jika Sukses, Lakukan :
            echo "<script> alert('Data Berhasil Ditambah');  
            window.location = 'tambah_ts.php';
            </script>"; // Redirect ke halaman index.php  
            }else{    // Jika Gagal, Lakukan :    
              echo "<script> alert('Terjadi Kesalahan, Data Gagal Ditambahkan');  
              window.location = 'tambah_ts.php';
            </script>";
          }
        }else{  // Jika gambar gagal diupload, Lakukan :
        echo "<script> alert('Gambar gagal diupload');  
        window.location = 'tambah_ts.php';
        </script>"; 
        } 
      }
      else{
          $query = "INSERT INTO training_support(ts_id, ts_name, ts_hp, ts_alamat) VALUES(null, '".$nama."', '".$hp."', '".$alamat."')";  
          $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel 
          if($sql){ // Cek jika proses simpan ke database sukses atau tidak    // Jika Sukses, Lakukan :
            echo "<script> alert('Data Berhasil Ditambah');  
            window.location = 'tambah_ts.php';
            </script>"; // Redirect ke halaman index.php  
            }else{    // Jika Gagal, Lakukan :    
              echo "<script> alert('Terjadi Kesalahan, Data Gagal Ditambahkan');  
              window.location = 'tambah_ts.php';
            </script>";
          }

      }
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
