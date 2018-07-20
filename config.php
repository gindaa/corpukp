<?php

  //$username = "root";
  //$password = "";
//$con = mysqli_connect("192.168.1.129","gg","gg");
$con = mysqli_connect("localhost","root","");
  //mysqli_connect("localhost", $username, $password);
mysqli_select_db($con,"room_corpu");



function head(){
  ?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Digital Signage</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="home.php">Admin</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">

            <a class="nav-link" href="home.php">
              <i class="fa fa-fw fa-home"></i>
              <span class="nav-link-text">Home</span>
            </a>

            <a class="nav-link" href="kelas.php">
              <i class="fa fa-fw  fa-building-o"></i>
              <span class="nav-link-text">Data Kelas</span>
            </a>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw  fa-calendar"></i>
                <span class="nav-link-text">Kegiatan</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseComponents">
                <li>
                  <a href="kegiatan.php">Data Kegiatan</a>
                </li>
                <li>
                  <a href="tambah_kegiatan.php">Tambah Kegiatan</a>
                </li>
              </ul>

              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-address-card-o"></i>
                <span class="nav-link-text">Training Support</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseComponents2">
                <li>
                  <a href="training_support.php">Data Training Support</a>
                </li>
                <li>
                  <a href="tambah_ts.php">Tambah Training Support</a>
                </li>
              </ul>

            </li>  
          </ul>    

          <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
              <a class="nav-link text-center" id="sidenavToggler">
                <i class="fa fa-fw fa-angle-left"></i>
              </a>
            </li>
          </ul>


          <ul class="navbar-nav ml-auto">
            
              <li class="nav-item">
              <a href="logout.php" onclick="JavaScript:return confirm ('Anda akan logout ?')"> <i class="fa fa-fw fa-sign-out" ></i>Logout</a>
              </li>
            </ul>
          </div>
        </nav>

        <?php
      }

      function foot(){
        ?>

        <footer class="sticky-footer">
          <div class="container">
            <div class="text-center">
              <small>Copyright © Telkom Corporate University Center 2018</small>
            </div>
          </div>
        </footer>

        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="index.html">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="js/sb-admin-datatables.min.js"></script>
        <!-- <script src="js/sb-admin-charts.min.js"></script> -->
        <script type="text/javascript" src="js/sb-admin-charts.js"></script>
        <?php
      }
      ?>