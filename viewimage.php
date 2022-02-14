<?php
header("content-type: image/jpeg"); #image/jpeg

# Options
#############
# i: id of source image (OK)
# w: width of new image   (OK... needs new work)
# q: quality of new image (OK)
# r: rotation degree      (Need next)
# cx: crop x1 on rotated image    (Need next)
# cy: crop y1 on rotated image    (Need next)
# cw: crop width on rotated image    (Need next)
# ch: crop height on rotated image    (Need next)
# brightness: brightness  (Next2)
# gamma: gamma adjust     (Later)
# contrast: contrast      (Next2)
# blur: yes/no            (Later)
# smooth: smoothness      (Later)
# negate: yes/no          (Later)
# colorize: #RRGGBB       (Next3)

##############
# So, the image will be:
##############
# loaded,
# resized for rotation
# rotated,
# cropped and resized for final dimension
### gamma adjusted,
#2# brightness adjusted
#2# contrasted
### blurred
### smoothed
### negated
#3# grayscaled/colorized
# displayed at given quality
##############

//chdir('../photos');
$img_id=$_GET['i'];
$src_file="../photos/${img_id}.jpg";
$src_img=imagecreatefromjpeg($src_file);
$src_size=getimagesize($src_file);
$src_width=$src_size[0];
$src_height=$src_size[1];

$dst_qual=$_GET['q'];
if(!$dst_qual) { $dst_qual=50; }
$dst_width=$_GET['w'];
if(!$dst_width){$dst_width=100; }
$xf_rot=$_GET['r'];
if(!$xf_rot) {$xf_rot=0;}
$xf_crop_x=$_GET['cx'];
if(!$xf_crop_x) {$xf_crop_x=0;}
$xf_crop_y=$_GET['cy'];
if(!$xf_crop_y) {$xf_crop_y=0;}
$xf_crop_w=$_GET['cw'];
if(!$xf_crop_w) {$xf_crop_w=$src_width-$xf_crop_x*2;}
$xf_crop_h=$_GET['ch'];
if(!$xf_crop_h) {$xf_crop_h= $xf_crop_w*$src_height/$src_width;}

$dst_img='';

if($xf_rot) {
    $prerot=imagecreatetruecolor($src_width,$src_width);
    imagecopyresampled($prerot,$src_img,0,0,0,0,$src_width,$src_height,$src_width,$src_height);
    imagedestroy($src_img);
#imagejpeg($prerot,'',50);

    $rot_img=imagerotate($prerot,$xf_rot,0);
	$tmp=$xf_crop_h;
	$xf_crop_h=$xf_crop_w;
	$xf_crop_w=$tmp;
    imagedestroy($prerot);
#imagejpeg($rot_img,'',50);
    $dst_img=imagecreatetruecolor($dst_width,$dst_width*$xf_crop_h/$xf_crop_w);
    imagecopyresampled($dst_img,$rot_img,0,0,$xf_crop_x,$xf_crop_y,$dst_width,$dst_width*$xf_crop_h/$xf_crop_w,$xf_crop_w,$xf_crop_h);
    imagedestroy($rot_img);
} else {
    $dst_img=imagecreatetruecolor($dst_width,$dst_width*$xf_crop_h/$xf_crop_w);
    imagecopyresampled($dst_img,$src_img,0,0,$xf_crop_x,$xf_crop_y,$dst_width,$dst_width*$xf_crop_h/$xf_crop_w,$xf_crop_w,$xf_crop_h);
    imagedestroy($src_img);
}
/*
print <<<EOL

$img_id,$src_file
$src_width,$src_height
$dst_qual
$dst_width,$dst_height
$aspect
$xf_crop_x,$xf_crop_y
$xf_crop_w,$xf_crop_h
$xf_rot
EOL;
if($xf_rot) {
print <<<EOQ

$cosrot,$sinrot
$rot_width,$rot_height
EOQ;
}*/
imagejpeg($dst_img,'',$dst_qual);
imagedestroy($dst_img);
?>
