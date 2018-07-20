<?php
	session_start();
	if(($_SESSION['login']==true) && ($_SESSION['username']!= '')){
		include 'config.php';
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
	?>
	<!DOCTYPE html>
	<html lang="en">
		
		<?php
			$db = new mysqli('localhost','root','','room_corpu');//set your database handler
			$query = "SELECT building_id,building_name FROM building";
			$result = $db->query($query);
			
			while($row = $result->fetch_assoc()){
				$categories[] = array("id" => $row['building_id'], "val" => $row['building_name']);
			}
			
			$query = "SELECT room_id, building_id, room_name FROM classroom";
			$result = $db->query($query);
			
			while($row = $result->fetch_assoc()){
				$subcats[$row['building_id']][] = array("id" => $row['room_id'], "val" => $row['room_name']);
			}
			
			$jsonCats = json_encode($categories);
			$jsonSubCats = json_encode($subcats);
			
			
		?>
		
		<?php
			head();
		?>
		
		<head>
			<script type='text/javascript'>
				<?php
					echo "var categories = $jsonCats; \n";
					echo "var subcats = $jsonSubCats; \n";
				?>
				function loadCategories(){
					var select = document.getElementById("categoriesSelect");
					select.onchange = updateSubCats;
					for(var i = 0; i < categories.length; i++){
						select.options[i] = new Option(categories[i].val,categories[i].id);          
					}
				}
				function updateSubCats(){
					var catSelect = this;
					var catid = this.value;
					var subcatSelect = document.getElementById("subcatsSelect");
					subcatSelect.options.length = 0; //delete all options if any present
					for(var i = 0; i < subcats[catid].length; i++){
						subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
					}
				}
			</script>
			
		</head>
		
		<body onload='loadCategories()'>
			<div class="content-wrapper">
				<div class="container-fluid">
					<!-- Breadcrumbs-->
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="kegiatan.php">Kegiatan</a>
						</li>
						<li class="breadcrumb-item active">Tambah Kegiatan</li>
					</ol>
					<form method="post" action="#" >
						<div class="form-group">
							<label>Nama Kegiatan</label>
							<input type="text" class="form-control" name="nama_kegiatan">
						</div>
						
						<div class="form-group">
							<label>Tanggal Mulai</label>
							<input type="date" class="form-control" name="tanggal_mulai">
						</div>
						
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="date" class="form-control" name="tanggal_selesai">
						</div>
						
						<?php
							$query = "SELECT * FROM building";
							$res = mysqli_query($con, $query);
							if (mysqli_num_rows($res)>0) {
								
							?>
							<div class="form-group">
								<label>Gedung</label>  
								<select id='categoriesSelect' name="gedung" class="form-control"> 
									<?php while ($data=mysqli_fetch_array($res)) {  ?> 
										<option value="<?php echo $data['building_id'] ?>"><?php echo $data['building_name'] ?></option>  
										<?php
										}
									?>  
								</select>  
								<?php
									
								}
							?> 
							
						</div>
						<div class="form-group">
							<?php
								$query1 = "SELECT * FROM classroom";
								$res1 = mysqli_query($con, $query1);
								if (mysqli_num_rows($res1)>0) {
									
								?>
								<div class="form-group">
									<label>Kelas</label>  
									<select id='subcatsSelect' name="kelas" class="form-control"> 
										<?php while ($data1=mysqli_fetch_array($res1)) {  ?> 
											<option value="<?php echo $data1['room_id'] ?>"><?php echo $data1['room_name'] ?></option>  
											<?php
											}
										?>  
									</select>  
									<?php
										
									}
								?>  
							</div>
						</div>
						
						<div class="form-group">
							<label>Status</label>
							<input type="text" class="form-control" name="status">
						</div>
						
						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" class="form-control" name="keterangan">
						</div>
						<input type="submit" class="btn btn-primary" name="tambah" value="Tambah Kegiatan">
					</form>
					
					<?php
						
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							
							if (($_POST["nama_kegiatan"]) || ($_POST['status']) || ($_POST['keterangan']) || ($_POST['tanggal_mulai']) || ($_POST['tanggal_selesai']) == "") {
								echo "<script> 
								alert('Mohon Isi Form dengan Lengkap');
								</script>";
								} else {
								$nama_kegiatan = $_POST["nama_kegiatan"];
								$tanggal_mulai = $_POST['tanggal_mulai'];
								$tanggal_selesai = $_POST['tanggal_selesai'];
								$gedung = $_POST['gedung'];
								$status  = $_POST['status'];
								$keterangan = $_POST['keterangan'];
								$kelas  = $_POST['kelas'];
								
								$querytambah = "INSERT INTO event(event_id, event_name, tanggal_mulai, tanggal_selesai, status, keterangan, room_id) VALUES(null,'$nama_kegiatan','$tanggal_mulai','$tanggal_selesai' ,'$status','$keterangan','$kelas')";
								
								$restambah = mysqli_query($con, $querytambah);
								if ($restambah) {
									echo "<script> alert('Data Berhasil Ditambah');  
									window.location = 'tambah_kegiatan.php';    
									</script>";
									}else{
									var_dump($restambah);
									echo "<script> alert('Terjadi Kesalahan, Gagal Ditambahkan');  
									window.location = 'tambah_kegiatan.php';    
									</script>";
								}
							}
						}
						
					?>
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
		echo "<sctipt> 
		alert('Anda Harus Login Terlebih Dahulu');
        </script>";
		header("Location:index.php");
	}
?>
