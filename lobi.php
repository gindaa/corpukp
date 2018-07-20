<!DOCTYPE html>
<html lang="en">
<?php
include("config.php");
?>
<head>
  <title>Lobi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="css/w3.css"> -->
  <link rel="stylesheet" type="text/css" href="style_.css">
  <!-- <style>
    .mySlides {display:none;}
  </style> -->
  <body>
   <!--  <div class="mySlides w3-animate-left"> -->
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
      <!-- </div> -->
    </div>
    <div class="box2">
      <div id="container"">
        <div id="sliderbox">
          <img src="map1.png" height="260" width="768" />
          <img src="map2.jpg" height="260" width="768" />
          <img src="map3.jpg" height="260" width="768" />
        </div>
      </div>
    </div>

    <div class="box3">
      <img src="social media white font.png" class="sosmed">
    </div>

    <div class="box4">
      <h1 class="jalan">Jalan Gegerkalong Hilir No.47 Bandung 40152, Indonesia</h1>
    </div>
    <script>
      var myIndex = 0;
      carousel();

      function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 2500);    
      }
    </script>
  </body>
</head>
<hr>
</html>