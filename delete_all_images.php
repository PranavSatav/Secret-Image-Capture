<?php
$files = glob('photos/*.png');
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
    }
}
echo 'All images deleted.';
?>
