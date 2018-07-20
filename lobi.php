<!DOCTYPE html>
<html lang="en">
<?php
include("config.php");
?>
<head>
  <title>Lobi</title>
  <link rel="stylesheet" type="text/css" href="style_.css">
  <body>
   <div class="box">
     <img src="logo_corpu.png" class="logo"> 
     <h1>CACUK SUDARIJANTO</h1>
     <?php 
     $query = "SELECT event_id, event_name, tanggal_mulai, tanggal_selesai, room_name, keterangan, status
     FROM event  
     JOIN classroom  USING(room_id) 
     JOIN building USING(building_id)
     WHERE building_id='cacuk' AND status ='Terjadwal' OR status='Berlangsung'";
     $tampil = mysqli_query($con, $query);
     if (mysqli_num_rows($tampil)>0) {
      ?>      
      <div align="center">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr><hr>
              <th>NO</th>
              <th>KEGIATAN</th>
              <th>MULAI</th>
              <th>SELESAI</th>
              <th>KELAS</th>
              <th>KETERAGAN</th>
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
              $mulai2 = date('d F Y', strtotime($tanggal_mulai));
              //'08 September 1994' 
              $selesai1 = date('d-m-Y', strtotime($tanggal_selesai));
              $selesai2 = date('d F Y', strtotime($tanggal_selesai));
              //echo $format1;
              ?>
              <tr>
                <td align="center"><?php echo "$i"; ?></td>
                <td align="center"><?php echo $data['event_name']; ?></td>
                <td align="center"><?php echo $mulai2;?></td>
                <td align="center"><?php echo $selesai2;?></td>
                <td align="center"><?php echo $data['room_name']; ?></td>
                <td align="center"><?php echo $data['keterangan']; ?></td>
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
<hr>
</html>