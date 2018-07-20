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
     		$query = "SELECT event_id, event_name, event_logo, tanggal_mulai, tanggal_selesai, room_name, keterangan, status, building_name, room_name

		    FROM event  
		    JOIN classroom  USING(room_id) 
		    JOIN building USING(building_id)
		    WHERE room_id='cacuk_203'";
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
		</div>
		<div class="box-3-2">
		</div>
		<div class="box-4">
			<img src="social media white font.png" class="sosmed">
		</div>
		<div class="box-5">
		</div>
	</body>
	
</html>						