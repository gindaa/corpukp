<?php 

include 'config.php';
$id= $_GET['id'];

$query = "DELETE FROM `event_training_support` WHERE `event_id` = '$id';";
$res = mysqli_query($con, $query);

$query = "DELETE FROM training_support WHERE ts_id='$id'";
$res = mysqli_query($con, $query);

if ($res) {
 echo "<script> alert('Data Berhasil Dihapus');  
                             window.location = 'training_support.php';    
                    </script>";
     }else{
      echo "<script> alert('Terjadi Kesalah');  
                             window.location = 'training_support.php';    
                    </script>";
     }


?>