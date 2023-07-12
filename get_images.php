<?php
// Retrieve image filenames from the 'photos' folder
$imageFiles = glob('photos/*.png');

echo '<table>';
echo '<tr><th>Thumbnail</th><th>Date/Time</th><th>Action</th></tr>';

foreach ($imageFiles as $filename) {
    echo '<tr>';
    echo '<td><img src="' . $filename . '" width="100"></td>';
    echo '<td>' . date('Y-m-d H:i:s', filemtime($filename)) . '</td>';
    echo '<td><button onclick="deleteImage(\'' . $filename . '\')">Delete</button></td>';
    echo '</tr>';
}

echo '</table>';
?>
