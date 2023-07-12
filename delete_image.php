<?php
$filename = $_POST['filename'];
if (file_exists($filename)) {
    unlink($filename);
    echo 'Image deleted: ' . $filename;
} else {
    echo 'Image not found: ' . $filename;
}
?>
