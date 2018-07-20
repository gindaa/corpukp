      <?php
      if (isset($_POST['username'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];


        if (($username =='admin')&&($password=='admin')) {
         session_start();
         $_SESSION['username']='admin';
         $_SESSION['password']='admin';
         $_SESSION['login']=true;
         echo "<script> window.location = 'home.php';

       </script>";
     }else{
      echo "<script> alert('Username atau Password Salah');  
      window.location = 'index.php';    
    </script>";
  }
}

?>