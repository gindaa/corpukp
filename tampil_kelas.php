<!DOCTYPE html>
<html lang="en">
<?php
include("config.php");
?>
<head>
  <title>Kelas</title>
  <link rel="stylesheet" type="text/css" href="style_class.css">
  <body>
   <div class="box">
     <!-- <img src="white corpu.png" class="logo">  -->
     <!-- <h1>Telkom Corporate</h1> -->
     <?php 
     $query = "SELECT event_id, event_name, tanggal_mulai, tanggal_selesai, room_name, keterangan, status, building_name
     FROM event  
     JOIN classroom  USING(room_id) 
     JOIN building USING(building_id)
     WHERE room_id='cacuk_205'";
     $tampil = mysqli_query($con, $query);
     $data = mysqli_fetch_array($tampil);
     ?>      
     <div align="left">
       <?php 
       $tanggal_mulai = $data['tanggal_mulai'];
       $tanggal_selesai = $data['tanggal_selesai'];
              //'08-09-1994'
       $mulai1 = date('d-m-Y', strtotime($tanggal_mulai));
       $mulai2 = date('d F Y', strtotime($tanggal_mulai));
                      //'08 September 1994'
       $selesai1 = date('d-m-Y', strtotime($tanggal_selesai));
       $selesai2 = date('d F Y', strtotime($tanggal_selesai));
       $kegiatan = $data['event_name'];
       $gedung = $data['building_name'];
       $kelas = $data['room_name'];

       // echo $data['event_name'];
       // echo $mulai2;
       // echo $selesai2;
       // echo $data['room_name'];
       // echo $data['keterangan'];
       ?>
       <h1><?php echo "GEDUNG  "; echo $gedung; ?><br><?php echo $kelas; ?></h1>
       <h2><?php echo $kegiatan; ?></h2>
       <h3><?php echo $mulai2; ?></h3>
       <h4><?php echo "s/d" ?></h4>
       <h3><?php echo $selesai2; ?></h3>

     </div>
     <?php 
     $query2 = "SELECT * FROM training_support";
     $tampil2 = mysqli_query($con, $query2);
     $data2 = mysqli_fetch_array($tampil2);
     ?>
     <div class="box2">
       <h3 class="ts">TRAINING SUPPORT on DUTY</h3>
       <img class="center" src="images/<?php echo $data2['ts_foto']; ?>" width="100" align="center"> 
       <h5 align="center"><?php echo $data2['ts_name'];?></h3>
        <h5 align="center"><?php echo $data2['ts_hp'];?></h3>
        </div>
      </body>
    </head>
    <hr>
    </html>