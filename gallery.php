<html>
<head>
<title>
Pictures
</title>
</head>
<body>
<h1>Simple Picture Gallery</h1>
<hr />
<p>
<?php

$thumb_qual=$_GET['tq'];
if(!$thumb_qual) {$thumb_qual= 20;}
$thumb_width=$_GET['tw'];
if(!$thumb_width) {$thumb_width=100;}
$big_qual=$_GET['bq'];
if(!$big_qual) {$big_qual=80;}
$big_width=$_GET['bw'];
if(!$big_width) {$big_width=1024;}

$start_img=$_GET['start'];
if(!$start_img) {$start_img=1000001;}
$number_img=$_GET['num'];
if(!$number_img) {$number_img=40;}
$camera_id='p';

for($i=$start_img; $i< $start_img+$number_img; ++$i) {
print <<<EOK
<a href="http://www.sessrumnir.net/gallery/infoimage.php?i=$camera_id$i&bq=$big_qual&bw=$big_width">
<img src="http://www.sessrumnir.net/gallery/viewimage.php?i=$camera_id$i&q=$thumb_qual&w=$thumb_width" alt="$camera_id$i"/>
</a>
EOK;

}

?>
</p>
<hr />
<p>
[<?php
for($j=1000001; $j < 1000700; $j+=$number_img) {
    $lef=substr($j,3);
    $rig=substr($j+$number_img-1,3);

    if($j==$start_img) {
        print <<<EOX
$lef-$rig |
EOX;
    } else {
        print <<<EOY
<a href="http://www.sessrumnir.net/gallery/gallery.php?start=$j&num=$number_img&tq=$thumb_qual&tw=$thumb_width&bq=$big_qual&bw=$big_width">
$lef-$rig
</a> |
EOY;
    }
}
?>
]</p>
</body>
</html>
