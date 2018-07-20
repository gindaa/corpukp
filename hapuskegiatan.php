<?php 

include 'config.php';
$id= $_GET['id'];

$query = "DELETE FROM event WHERE event_id='$id'";
$res = mysqli_query($con, $query);

if ($res) {
 echo "<script> alert('Data Berhasil Dihapus');  
                             window.location = 'kegiatan.php';    
                    </script>";
     }else{
      echo "<script> alert('Terjadi Kesalah');  
                             window.location = 'kegiatan.php';    
                    </script>";
     }


?>