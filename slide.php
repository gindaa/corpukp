
<?php
//url website
$siteURL = "http://codingan.com/";

//memanggil API Google PageSpeed Insights
$googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$siteURL&screenshot=true");

//data decode json
$googlePagespeedData = json_decode($googlePagespeedData, true);

//data screenshot
$screenshot = $googlePagespeedData['screenshot']['data'];
$screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 

//menampilkan gambar screenshot
echo "<img src=\"data:image/jpeg;base64,".$screenshot."\" />";

?>

<form method="post" action="screenshot.php" >
<p>Website URL: <input type="text" name="url" value="" /></p>
<input type="submit" name="submit" value="CAPTURE">