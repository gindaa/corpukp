<!DOCTYPE html>
<html lang="en">
<?php
include("config.php");
?>
<head>
  <title>Tes</title>
  <link rel="stylesheet" type="text/css" href="style_.css">
  <body>
   <div class="box">
     <img src="logo_corpu.png" class="avatar"> 
     <h1>Telkom Corporate</h1>
     <?php 
     $query = "SELECT event_id, event_name, tanggal_mulai, tanggal_selesai, room_name, keterangan, status
     FROM event  
     JOIN classroom  USING(room_id) 
     JOIN building USING(building_id)
     WHERE building_id='cacuk'";
     $tampil = mysqli_query($con, $query);
     if (mysqli_num_rows($tampil)>0) {

      ?>      
      <div align="center">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="10">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kegiatan</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Kelas</th>
              <th>Keterangan</th>
              <!-- <th>Status</th> -->
            </tr>
          </thead>
          <tbody>

            <?php
            $i=1; 
            while ($data = mysqli_fetch_array($tampil)) {
              $tanggal_mulai = $data['tanggal_mulai'];
              $tanggal_selesai = $data['tanggal_selesai'];
              //'08-09-1994'
              $mulai1 = date('d-m-Y', strtotime($tanggal_mulai));
              $mulai2 = date('d F Y', strtotime($tanggal_selesai));
              //'08 September 1994'
              $selesai1 = date('d-m-Y', strtotime($tanggal_mulai));
              $selesai2 = date('d F Y', strtotime($tanggal_mulai));
              //echo $format1;
              ?>
              <tr>
                <td align="center"><?php echo "$i"; ?></td>
                <td align="center"><?php echo $data['event_name']; ?></td>
                <!-- <td align="center"><?php echo $data['tanggal_mulai']; ?></td> -->
                <td align="center"><?php echo $mulai2;?></td>
                <td align="center"><?php echo $selesai2;?></td>
                <!-- <td align="center"><?php echo $data['tanggal_selesai']; ?></td> -->
                <td align="center"><?php echo $data['room_name']; ?></td>
                <td align="center"><?php echo $data['keterangan']; ?></td>
                <!-- <td align="center"><?php echo $data['status']; ?></td> -->
              </tr>
              <?php
              $i++;
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</head>
</html>