<!DOCTYPE html>
<html lang="en">
	<?php
		include("config.php");
	?>
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<head>
		<title>Kelas</title>
	</head>
	<link rel="stylesheet" type="text/css" href="style_wakwaw.css">
	<body>
		<div class="box-1">	
			<img src="logo_corpu.png" class="logo"> 
			<?php 
     		$query = "SELECT event_id, event_name, event_logo, tanggal_mulai, tanggal_selesai, room_name, keterangan, status, building_name, room_name, ts_name, ts_foto, ts_hp
		    FROM event  
		    JOIN classroom  USING(room_id) 
		    JOIN building USING(building_id)
		    JOIN event_training_support USING(event_id)
		    JOIN training_support USING(ts_id)
		    WHERE room_id='cacuk_202'";
		    $tampil = mysqli_query($con, $query);
		    $data = mysqli_fetch_array($tampil);
		    ?>
		    <h1 class="kelas"><?php echo "ROOM " ; echo " 201" ?></h1>
		    <h1 class="gedung"><?php echo " CACUK SUDARIJANTO " ?></h1>
		</div>
		<div class="box-2">
			<img class="logo2" src="images/<?php echo $data['event_logo']; ?>" alt="">
			<?php 
				$kegiatan = $data['event_name'];
			?>
			<h1 class="kegiatan"><?php echo "$kegiatan"?></h1>
		</div>
		<div class="box-3-1">
			<img src="cctv.jpg" class="cctv">
		</div>
		<div class="box-3-2">
			<h1 class="tson">TRAINING SUPORT on DUTY</h1>
		</div>
		<?php if (mysqli_num_rows($tampil)==2) { ?>
				<div class="box-3-2-1">
					<img class ="foto" src="images/<?php echo $data['ts_foto']; ?>">
				</div>
				<div class="box-3-2-2">
					<?php 
						$nama = $data['ts_name'];
						$hp = $data['ts_hp'];
					?>
					<h1 class="nama"><?php echo "$nama"; echo"ini2"?></h1>
					<h1 class="hp"><?php echo "$hp"?></h1>	
					<h1>ini 2</h1>
				</div>
				<div class="box-3-2-1">
					<img class ="foto2" src="images/<?php echo $data['ts_foto']; ?>">
				</div>
				<div class="box-3-2-2">
					<?php 
						$nama = $data['ts_name'];
						$hp = $data['ts_hp'];
					?>
					<h1 class="nama2"><?php echo "$nama"?></h1>
					<h1 class="hp2"><?php echo "$hp"?></h1>			
				</div>
		<?php } else { ?>
			<div class="box-3-2-1">
				<img class ="foto" src="images/<?php echo $data['ts_foto']; ?>">
			</div>
			<div class="box-3-2-2">
				<?php 
					$nama = $data['ts_name'];
					$hp = $data['ts_hp'];
				?>
				<h1 class="nama"><?php echo "$nama"; echo"ini1"?></h1>
				<h1 class="hp"><?php echo "$hp"?></h1>	
				<h1></h1>		
			</div>
		<?php } ?>
		
		<div class="box-4">
			<img src="social media white font.png" class="sosmed">
		</div>
		<div class="box-5">
		</div>
	</body>
</html>						