<!DOCTYPE html>
<html>
<head>
    <title>Camera Capture</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            height: 100%;
        }

        .video-container {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .video-container video {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .controls-container {
            width: 50%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #f1f1f1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .controls-container h1 {
            text-align: center;
        }

        .controls-container button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
        }

        .controls-container h2 {
            margin-top: 20px;
        }

        .controls-container .table-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .controls-container table {
            border-collapse: collapse;
            margin-top: 10px;
            width: 100%;
        }

        .controls-container td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .controls-container .delete-btn {
            background-color: #ff4136;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .controls-container .delete-btn:hover {
            background-color: #d50000;
        }

        .controls-container .delete-all-btn {
            background-color: #ff4136;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .controls-container .delete-all-btn:hover {
            background-color: #d50000;
        }

        .controls-container .storage-info {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <script>
        var timer; // Timer variable for capturing photos
        var isCapturing = true; // Flag to indicate if capturing is in progress

        $(document).ready(function() {
            startCapturing(); // Start capturing on page load

            // Button click event handlers
            $("#stopBtn").click(function() {
                stopCapturing();
            });

            $("#startBtn").click(function() {
                startCapturing();
            });

            $("#deleteAllBtn").click(function() {
                deleteAllImages();
            });
        });

        function startCapturing() {
            isCapturing = true;
            $("#status").text("Capturing in progress...");

            // Request camera permission
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    var video = document.querySelector('video');
                    video.srcObject = stream;
                    video.play();

                    // Capture photo every 5 seconds
                    timer = setInterval(capturePhoto, 5000);
                })
                .catch(function(error) {
                    console.log("Camera permission denied:", error);
                    $("#status").text("Camera permission denied.");
                });
        }

        function capturePhoto() {
            if (!isCapturing) return; // Check if capturing is still in progress

            var canvas = document.createElement('canvas');
            var video = document.querySelector('video');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            var dataURL = canvas.toDataURL('image/png');
            savePhoto(dataURL);
        }

        function savePhoto(dataURL) {
            $.ajax({
                type: 'POST',
                url: 'save_photo.php',
                data: { image: dataURL },
                success: function(response) {
                    console.log(response);
                    updateImageTable(); // Update image table after saving photo
                }
            });
        }

        function stopCapturing() {
            isCapturing = false;
            clearInterval(timer);
            $("#status").text("Capturing stopped.");
        }

        function deleteImage(filename) {
            $.ajax({
                type: 'POST',
                url: 'delete_image.php',
                data: { filename: filename },
                success: function(response) {
                    console.log(response);
                    updateImageTable(); // Update image table after deleting photo
                }
            });
        }

        function deleteAllImages() {
            $.ajax({
                type: 'POST',
                url: 'delete_all_images.php',
                success: function(response) {
                    console.log(response);
                    updateImageTable(); // Update image table after deleting all photos
                }
            });
        }

        function updateImageTable() {
            $.ajax({
                type: 'GET',
                url: 'get_images.php',
                success: function(response) {
                    $("#imageTable").html(response);
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="video-container">
            <video></video>
        </div>
        <div class="controls-container">
            <h1>Camera Capture</h1>
            <div id="status"></div>

            <button id="stopBtn">Stop Capturing</button>
            <button id="startBtn">Start Capturing</button>
            <button id="deleteAllBtn">Delete All Images</button>

            <h2>Photos</h2>

            <div class="table-container">
                <table id="imageTable">
                    <?php include 'get_images.php'; ?>
                </table>
            </div>

            <div class="storage-info">
                Remaining Storage: <?php echo round(disk_free_space(__DIR__) / (1024 * 1024 * 1024), 2) . ' GB'; ?>
            </div>
        </div>
    </div>
</body>
</html>
