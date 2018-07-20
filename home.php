<?php
session_start();
if(($_SESSION['login']==true) && ($_SESSION['username']!= '')){
  include 'config.php';
  ?>

  <!DOCTYPE html>
  <html lang="en">


  <?php
  head();
  ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-rocket"></i>
              </div>
              <?php 
              $query = "SELECT room_id, room_name, room_count, building_name FROM classroom JOIN building USING(building_id) WHERE room_count = (SELECT MAX(room_count) FROM classroom)";
              $tampil = mysqli_query($con, $query);
              $data = mysqli_fetch_array($tampil);
              ?>
              <div class="mr-5" style="">Kelas Paling Sering Digunakan: <?php echo $data['building_name']; 
              echo "  "; echo $data['room_name'];
              ?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="detailmax.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-chevron-circle-down"></i>
              </div>
              <?php 
              $query2 = "SELECT room_id, room_name, room_count, building_name FROM classroom JOIN building USING(building_id) WHERE room_count = (SELECT MIN(room_count) FROM classroom)";
              $tampil2 = mysqli_query($con, $query2);
              $data2 = mysqli_fetch_array($tampil2);
              ?>
              <div class="mr-5">Kelas Paling Jarang Digunakan:  <?php echo $data2['building_name']; 
              echo "  "; echo $data2['room_name'];
              ?> </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="detailmin.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus-square"></i>
              </div>
              <?php
              $query3 = "SELECT event_id, event_name FROM event WHERE event_id = (SELECT MAX(event_id) FROM event)";
              $tampil3 = mysqli_query($con, $query3);
              $data3 = mysqli_fetch_array($tampil3);
              ?>
              <div class="mr-5">Baru Saja Ditambahkan Kegiatan: <?php echo $data3['event_name'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="detailbaru.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <?php
              $query4 = "SELECT * FROM event 
              WHERE (MONTH(tanggal_mulai) = 
              MONTH(CURRENT_DATE()) AND YEAR(tanggal_mulai) = YEAR(CURRENT_DATE())) 
              OR (MONTH(tanggal_selesai) = 
              MONTH(CURRENT_DATE()) AND YEAR(tanggal_selesai) = YEAR(CURRENT_DATE()))";
              $tampil4 = mysqli_query($con, $query4);
              $data4 = mysqli_fetch_array($tampil4);
              $jumlah = mysqli_num_rows($tampil4);
              ?>
              <div class="mr-5">Total Kegiatan Bulan Ini:  <?php echo $jumlah;?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="detailbulanini.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->

      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <!-- <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Bar Chart Example</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8 my-auto">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                  </div>
                  <div class="col-sm-4 text-center my-auto">
                    <div class="h4 mb-0 text-primary">$34,693</div>
                    <div class="small text-muted">YTD Revenue</div>
                    <hr>
                    <div class="h4 mb-0 text-warning">$18,474</div>
                    <div class="small text-muted">YTD Expenses</div>
                    <hr>
                    <div class="h4 mb-0 text-success">$16,219</div>
                    <div class="small text-muted">YTD Margin</div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div> -->
            <!-- Card Columns Example Social Feed-->

            <hr class="mt-2">


            <!-- /Card Columns-->
          </div>
          <div class="col-lg-4">

            <!-- <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-bell-o"></i> Feed Example</div>
                <div class="list-group list-group-flush small">
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                      <div class="media-body">
                        <strong>David Miller</strong>posted a new article to
                        <strong>David Miller Website</strong>.
                        <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                      </div>
                    </div>
                  </a>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                      <div class="media-body">
                        <strong>Samantha King</strong>sent you a new message!
                        <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
                      </div>
                    </div>
                  </a>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                      <div class="media-body">
                        <strong>Jeffery Wellings</strong>added a new photo to the album
                        <strong>Beach</strong>.
                        <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
                      </div>
                    </div>
                  </a>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                      <div class="media-body">
                        <i class="fa fa-code-fork"></i>
                        <strong>Monica Dennis</strong>forked the
                        <strong>startbootstrap-sb-admin</strong>repository on
                        <strong>GitHub</strong>.
                        <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                      </div>
                    </div>
                  </a>
                  <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div> -->
          </div>
          <!-- 
          Area Chart Example
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-area-chart"></i> Area Chart Example</div>
              <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div> -->
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
