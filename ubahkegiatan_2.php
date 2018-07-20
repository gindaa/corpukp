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
          <a href="kegiatan.php">Kegiatan</a>
        </li>
        <li class="breadcrumb-item active">Ubah Data Kegiatan</li>
      </ol>
      <?php
      $id = $_GET['id'];
      $querydata = "SELECT event_name, tanggal_mulai, tanggal_selesai, building_name, room_name, keterangan, building_id, room_id, status
      FROM event
      JOIN classroom USING(room_id)
      JOIN building  USING(building_id)
      WHERE event_id ='$id'";

      $resdata = mysqli_query($con, $querydata);
      $datakegiatan = mysqli_fetch_array($resdata);
      $kelaslama = $datakegiatan['room_id'];
      $statuslama = $datakegiatan['status'];

      ?>

      <form method="post" action="#">


        <div class="form-group">
          <label>Nama Kegiatan</label>
          <input type="text" class="form-control" name="nama_kegiatan" value="<?php echo $datakegiatan['event_name']; ?>">
        </div>

        <div class="form-group">
          <label>Tanggal Mulai</label>
          <input type="date" class="form-control" name="tanggal_mulai" value="<?php echo $datakegiatan['tanggal_mulai']; ?>">
        </div>

        <div class="form-group">
          <label>Tanggal Selesai</label>
          <input type="date" class="form-control" name="tanggal_selesai" value="<?php echo $datakegiatan['tanggal_selesai']; ?>">
        </div>

        <?php
        $query = "SELECT * FROM building";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res)>0) {

          ?>
          <div class="form-group">
            <label>Gedung</label>  
            <select name="gedung" class="form-control"> 
              <option value="<?php echo $datakegiatan['building_id']; ?>"> <?php echo $datakegiatan['building_name']; ?> </option>
              <?php while ($data=mysqli_fetch_array($res)) {  ?> 

              <option value="<?php echo $data['building_id'] ?>"><?php echo $data['building_name'] ?></option>  
              <?php
            }
            ?>  
          </select>  
          <?php

        }
        ?> 

      </div>
      <div class="form-group">
       <?php
       $query1 = "SELECT * FROM classroom";
       $res1 = mysqli_query($con, $query1);
       if (mysqli_num_rows($res1)>0) {

        ?>
        <div class="form-group">
          <label>Kelas</label>  
          <select name="kelas" class="form-control"> 
            <option value="<?php echo $datakegiatan['room_id']; ?>"> <?php echo $datakegiatan['room_name'];?> </option>
            <?php while ($data1=mysqli_fetch_array($res1)) {  ?> 

            <option value="<?php echo $data1['room_id'] ?>"><?php echo $data1['room_name'] ?></option>  
            <?php
          }
          ?>  
        </select>  
        <?php

      }
      ?>  
    </div>
  </div>

  <div class="form-group">
    <label>Status</label>
    <select name ="status" class="form-control">
      <option value="Terjadwal">Terjadwal</option>
      <option value="Berjalan">Berjalan</option>
      <option value="Selesai">Selesai</option>
      <option value="Dibatalkan">Dibatalkan</option>
    </select> 
  </div>

  <div class="form-group">
    <label>Keterangan</label>
    <input type="text" class="form-control" name="keterangan" value="<?php echo $datakegiatan['keterangan'] ?>" >
  </div>
  <input type="submit" class="btn btn-primary" name="ubah" value="Ubah Data Kegiatan">
</form>

<?php

if (isset($_POST['ubah'])) {

  $nama_kegiatan = $_POST['nama_kegiatan'];
  $tanggal_mulai = $_POST['tanggal_mulai'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
      //$gedung = $_POST['gedung'];
  $status  = $_POST['status'];
  $keterangan = $_POST['keterangan'];
  $kelas  = $_POST['kelas'];

  $queryubah ="UPDATE event
  SET event_name='$nama_kegiatan', tanggal_mulai='$tanggal_mulai', tanggal_selesai='$tanggal_selesai', status='$status', keterangan='$keterangan', room_id='$kelas' 
  WHERE event_id = '$id'";

  if ($statuslama != 'Selesai'){
    if($status == 'Selesai'){
      $query2 = "SELECT room_id, room_count 
      FROM classroom 
      WHERE room_id = '$kelas'";
      $resdata2 = mysqli_query($con, $query2);
      $data2 = mysqli_fetch_array($resdata2);
      $count = $data2['room_count']+1; 
      $query3 = "UPDATE classroom SET room_count='$count' WHERE room_id = '$kelas'";
      mysqli_query($con, $query3);
    }
  } elseif ($statuslama == 'Selesai') {
    if($status != 'Selesai'){
      $query4 = "SELECT room_id, room_count 
      FROM classroom 
      WHERE room_id = '$kelas'";
      $resdata4 = mysqli_query($con, $query4);
      $data4 = mysqli_fetch_array($resdata4);
      $count = $data4['room_count']-1; 
      $query5 = "UPDATE classroom SET room_count='$count' WHERE room_id = '$kelas'";
      mysqli_query($con, $query5);
    }
  } 
  if ($kelas != $kelaslama) {
    $query6 = "SELECT room_id, room_count 
    FROM classroom 
    WHERE room_id = '$kelas'";
    $resdata6 = mysqli_query($con, $query6);
    $data6 = mysqli_fetch_array($resdata6);
    $countbaru = $data6['room_count']+1; 
    $query7 = "UPDATE classroom SET room_count='$countbaru' WHERE room_id = '$kelas'";
    mysqli_query($con, $query7);

    $query8 = "SELECT room_id, room_count 
    FROM classroom 
    WHERE room_id = '$kelaslama'";
    $resdata8 = mysqli_query($con, $query8);
    $data8 = mysqli_fetch_array($resdata8);
    $countlama = $data8['room_count']-1; 
    $query9 = "UPDATE classroom SET room_count='$countlama' WHERE room_id = '$kelaslama'";
    mysqli_query($con, $query9);
  }
  



  $resubah = mysqli_query($con, $queryubah);

  if ($resubah) {
    echo "<script> alert('Data Berhasil Diubah');  
    window.location = 'kegiatan.php';    
  </script>";
}else{
  echo "<script> alert('Terjadi Kesalahan');  
  window.location = 'kegiatan.php';    
</script>";}
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
