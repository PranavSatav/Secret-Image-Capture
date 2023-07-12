<?php
$imageData = $_POST['image'];
$filename = 'photos/' . time() . '.png';
$file = fopen($filename, 'w');
fwrite($file, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
fclose($file);
echo 'Photo saved: ' . $filename;
?>
