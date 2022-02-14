<html>
<head>
<title>
Picture Information
</title>
</head>
<body>
<hr />
<p>
<?php
$big_qual=$_GET['bq'];
if(!$big_qual) {$big_qual=80;}
$big_width=$_GET['bw'];
if(!$big_width) {$big_width=1024;}

$img_id=$_GET['i'];
if(!$img_id) {$img_id='p1000001';}

print <<<EOK
<div style="float: left;">
<a href="http://www.sessrumnir.net/photos/${img_id}.jpg">
<img src="http://www.sessrumnir.net/gallery/viewimage.php?i=$img_id&q=$big_qual&w=$big_width" alt="$img_id"/>
</a>
</div>
EOK;

$exif = exif_read_data("../photos/${img_id}.jpg", 0, true);
foreach ($exif as $key => $section) {
   foreach ($section as $name => $val) {
       print "$key.$name: $val<br />\n";
   }
}

?>
</p>
<hr />
</body>
</html>
