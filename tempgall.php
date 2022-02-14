<html>
<head>
<title>
Practice temporary picture gallery
</title>
</head>
<body>
<p>
<?php

// So this file should ask for thumbnails of pictures 1-659 and display them all in a long wrapping row.
// each should link to the real picture

$bigqual=80;
$thumbqual=50;

if($_GET['tq']) {
	$thumbqual=$_GET['tq'];
}
if($_GET['bq']) {
	$bigqual=$_GET['bq'];
}

for($i=1000001; $i< 1000660; ++$i) {
if($_GET['fullsize'] == "yes") {
?>
<a href="http://www.sessrumnir.net/photos/p<?php print $i; ?>.jpg">
<?php
} else {
?>
<a href="http://www.sessrumnir.net/photos/bigger.php?qual=<?php print $bigqual; ?>&img=p<?php print $i; ?>.jpg">
<?php
}
?>
<img src="http://www.sessrumnir.net/photos/thumb.php?qual=<?php print $thumbqual; ?>&img=p<?php print $i; ?>.jpg" alt="<?php print $i; ?>" />
</a>
<?php	

}

?>
</p>
</body>
</html>
