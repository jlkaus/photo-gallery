<?php
header("content-type: image/jpeg");

$src_img=imagecreatefromjpeg($_GET['img']);
$srcsize=getimagesize($_GET['img']);
$dest_x=100;
$dest_y=75;

$dst_img=imagecreatetruecolor($dest_x,$dest_y);

imagecopyresampled($dst_img,$src_img,0,0,0,0,$dest_x,$dest_y,$srcsize[0],$srcsize[1]);




imagejpeg($dst_img,'',$_GET['qual']);
imagedestroy($dst_img);

imagedestroy($src_img);
?>