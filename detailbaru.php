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
        <li class="breadcrumb-item active">Detail Kegiatan Baru Ditambahkan</li>
      </ol>
      <!-- Icon Cards-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Kegiatan</div>
          <div class="card-body">
            <div class="table-responsive">
              <?php 
              $query = "SELECT event_id, event_name, tanggal_mulai, tanggal_selesai, building_name, room_name, status, keterangan
              FROM event
              JOIN classroom USING(room_id)
              JOIN building  USING(building_id)
              WHERE event_id = (SELECT MAX(event_id) FROM event)";
              $tampil = mysqli_query($con, $query);
              if (mysqli_num_rows($tampil)>0) {
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="2">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kegiatan</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                      <th>Gedung</th>
                      <th>Kelas</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Kegiatan</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                      <th>Gedung</th>
                      <th>Kelas</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
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
                      ?>
                      <tr>
                        <td><?php echo "$i"; ?></td>
                        <td><?php echo $data['event_name']; ?></td>
                        <td><?php echo $mulai2;?></td>
                        <td><?php echo $selesai2;?></td> 
                        <td><?php echo $data['building_name']; ?></td>
                        <td><?php echo $data['room_name']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td>  <a href="ubahkegiatan.php?id=<?php echo $data['event_id']; ?>" class="btn btn-info btn-xs btn-block">Ubah</a>
                          <a href="hapuskegiatan.php?id=<?php echo $data['event_id']; ?>" class="btn btn-danger btn-xs btn-block" onclick="return confirm('Anda Yakin Ingin Menghapus Data ?')">Hapus
                          </a></td>
                        </tr>
                        <?php
                        $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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

