<?php
session_start();
if(($_SESSION['login']==true) && ($_SESSION['username']!= '')){
  include 'config.php';
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <?php
  //$db = new mysqli('localhost','root','','room_corpu');//set your database handler
  $query = "SELECT building_id,building_name FROM building";
  //$result = $db->query($query);
  $result = mysqli_query($con, $query);
  

  while($row = $result->fetch_assoc()){
    $categories[] = array("id" => $row['building_id'], "val" => $row['building_name']);
  }

  $query = "SELECT room_id, building_id, room_name FROM classroom";
  $result = mysqli_query($con, $query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['building_id']][] = array("id" => $row['room_id'], "val" => $row['room_name']);
  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
  ?>

  <head>
    <script type='text/javascript'>
      <?php
      echo "var categories = $jsonCats; \n";
      echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>
  </head>

  <body onload='loadCategories()'>



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
          <li class="breadcrumb-item active">Tambah Kegiatan</li>
        </ol>
        <form method="post" action="#" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" class="form-control" name="nama_kegiatan">
          </div>

          <div class="form-group">
            <label>Jenis Kegiatan</label>
            <input type="text" class="form-control" name="jenis_kegiatan">
          </div>

          <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai">
          </div>

          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai">
          </div>

          <?php
          $query = "SELECT * FROM building";
          $res = mysqli_query($con, $query);
          if (mysqli_num_rows($res)>0) {

            ?>
            <div class="form-group">
              <label>Gedung</label>  
              <select id='categoriesSelect' name="gedung" class="form-control"> 
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
         $query1 = "SELECT * FROM classroom WHERE building_id='cacuk'";
         $res1 = mysqli_query($con, $query1);
         if (mysqli_num_rows($res1)>0) {

          ?>
          <div class="form-group">
            <label>Kelas</label>  
            <select id='subcatsSelect' name="kelas" class="form-control"> 
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
        <option value="Berlangsung">Berlangsung</option>
        <option value="Selesai">Selesai</option>
        <option value="Dibatalkan">Dibatalkan</option>
      </select> 
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <input type="text" class="form-control" name="keterangan">
    </div>

    <?php
    $query2 = "SELECT * FROM training_support";
    $res2 = mysqli_query($con, $query2);
      if (mysqli_num_rows($res2)>0) {
    ?>
      <div class="form-group">
        <label>Training Support</label>  
        <select name="ts_1" class="form-control"> 
        <?php while ($data2=mysqli_fetch_array($res2)) {  ?> 
          <option value="<?php echo $data2['ts_id'] ?>"><?php echo $data2['ts_name'] ?></option>  
        <?php
        }
        ?>  
        </select>  
        <?php
        }
        ?> 
      </div>

    <?php
    $query3 = "SELECT * FROM training_support";
    $res3 = mysqli_query($con, $query3);
      if (mysqli_num_rows($res3)>0) {
    ?>
      <div class="form-group">
        <label>Training Support 2 (Optional)</label>  
        <select name="ts_2" class="form-control"> 
          <option value=""> -- Tidak Ada -- </option>
        <?php while ($data3=mysqli_fetch_array($res3)) {  ?> 
          <option value="<?php echo $data3['ts_id'] ?>"><?php echo $data3['ts_name'] ?></option>  
        <?php
        }
        ?>  
        </select>  
        <?php
        }
        ?> 
      </div>

      <div class="form-group">
        <label>Logo (Optional)</label>
        <br>
        <input type="file" name="logo_kegiatan" accept=".jpg, .jpeg, .tiff, .gif, .bmp, .png">
      </div>


    <input type="submit" class="btn btn-primary" name="tambah" value="Tambah Kegiatan">
  </form>

  <?php

  if (isset($_POST['tambah'])) {
    if (($_POST['nama_kegiatan'] == "") || ($_POST['status'] == "") || ($_POST['jenis_kegiatan'] == "") || ($_POST['tanggal_mulai'] == "") || ($_POST['tanggal_selesai'] == "")) {
      echo "<script> 
      alert('Mohon Isi Form dengan Lengkap');
      </script>";
    }else { 
      
        $nama_kegiatan = $_POST['nama_kegiatan'];
        $jenis_kegiatan = $_POST['jenis_kegiatan'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        $status  = $_POST['status'];
        $keterangan = $_POST['keterangan'];
        $kelas  = $_POST['kelas'];
        $ts_1  = $_POST['ts_1'];
        $ts_2  = $_POST['ts_2'];        

        if($_FILES['logo_kegiatan']['name']){
          $logo_kegiatan = $_FILES['logo_kegiatan']['name'];
          $tmp = $_FILES["logo_kegiatan"]['tmp_name'];

          $logobaru = date('dmYHis').$logo_kegiatan;
          $path = "images/".$logobaru;

          if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak  
          // Proses  simpan ke Database  
          $querytambah = "INSERT INTO event (event_name, event_type, 
          tanggal_mulai, tanggal_selesai, event_logo, status, keterangan, room_id) VALUES('$nama_kegiatan','$jenis_kegiatan','$tanggal_mulai','$tanggal_selesai', '$logobaru', '$status','$keterangan','$kelas')";  
          }else{  // Jika gambar gagal diupload, Lakukan :
          echo "<script> alert('Gambar gagal diupload');  
          window.location = 'tambah_kegiatan.php';
          </script>"; 
          }         
        }else{
          $querytambah = "INSERT INTO event(event_name, event_type, 
          tanggal_mulai, tanggal_selesai, status, keterangan, room_id) 
          VALUES('$nama_kegiatan','$jenis_kegiatan','$tanggal_mulai','$tanggal_selesai' , 
          '$status','$keterangan','$kelas');";
        }
        
        $restambah = mysqli_query($con, $querytambah);
          
          
        $querytambah = "SELECT event_id FROM event ORDER BY event_id DESC LIMIT 1;";
          
        $restambah = mysqli_query($con, $querytambah);
          
        $event_id = mysqli_fetch_array($restambah);
         
        $ambil = $event_id['event_id'];
          
        if($ts_2!=""){
          $querytambah = "INSERT INTO `event_training_support` (`event_id`, `ts_id`) 
          VALUES ('$ambil', '$ts_1'), ('$ambil', '$ts_2');";
          } else {
          $querytambah = "INSERT INTO `event_training_support` (`event_id`, `ts_id`) 
          VALUES ('$ambil', '$ts_1');";
        }

        $restambah = mysqli_query($con, $querytambah);      

        if ($restambah) {
          if($status == 'Selesai'){
            $query2 = "SELECT room_id, room_count  
            FROM classroom
            WHERE room_id = '$kelas'";
            $resdata2 = mysqli_query($con, $query2);
            $data2 = mysqli_fetch_array($resdata2);
            $count = $data2['room_count']+1; 
            $query3 = "UPDATE classroom SET room_count='$count' WHERE room_id = '$kelas'";
          }
          mysqli_query($con, $query3);

          echo "<script> alert('Data Berhasil Ditambah');  
          window.location = 'tambah_kegiatan.php';    
        </script>";
      }else{
        // var_dump($restambah);
        echo "<script> alert('Terjadi Kesalahan, Gagal Ditambahkan');  
        window.location = 'tambah_kegiatan.php';    
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
