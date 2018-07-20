<?php
 session_start();
 unset($_SESSION['login'], $_SESSION['username']);
 //header("location : index.php");
 echo "<script> window.location = 'index.php'; </script>";
?>