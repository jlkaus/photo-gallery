<?php
header("content-type: image/jpeg");

//chdir('../photos');
$imgid=$_GET['img'];
$srcfile="../photos/${imgid}.jpg";

$src_img=imagecreatefromjpeg($srcfile);
$srcsize=getimagesize($srcfile);
$dstwide=$_GET['width'];
$dstqual=$_GET['qual'];
if(!$dstwide) {
    $dstwide=100;
}
if(!$dstqual) {
    $dstqual=50;
}
$dest_x=$dstwide;
$ratio=$dest_x/$srcsize[0];
$dest_y=$srcsize[1]*$ratio;

$dst_img=imagecreatetruecolor($dest_x,$dest_y);

imagecopyresampled($dst_img,$src_img,0,0,0,0,$dest_x,$dest_y,$srcsize[0],$srcsize[1]);




imagejpeg($dst_img,'',$dstqual);
imagedestroy($dst_img);

imagedestroy($src_img);
?>
