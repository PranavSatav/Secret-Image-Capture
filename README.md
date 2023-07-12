Create a 'photos' folder in your directory FIRST to properly run this files.

# Camera Capture

Camera Capture is a web application that allows users to capture photos using their device's camera and manage the captured images. This application provides a simple interface to start and stop capturing photos, view the captured images in a tabular format, delete individual or all images, and monitor the remaining storage on the server.

## Features

- Capture photos using the device's camera at regular intervals.
- Start and stop capturing photos.
- View captured images with timestamps in a tabular format.
- Delete individual images by clicking on the delete button in the table.
- Delete all images at once.
- Monitor and display the remaining storage on the server.

## Prerequisites

- Web server (Apache, Nginx, etc.) with PHP support.
- Modern web browser with camera support.

## How to Run

1. Clone the repository to your local machine or download the ZIP file.
git clone https://github.com/your-username/camera-capture.git


2. Place the project files in the root directory of your web server.

3. Ensure that PHP is properly configured and enabled on your web server.

4. Open a web browser and navigate to the URL where the project is hosted.

5. When accessing the application for the first time, the browser will prompt for camera permission. Grant the permission to enable camera access.

6. The application will automatically start capturing photos every 5 seconds. You can click the "Stop Capturing" button to stop capturing at any time.

7. Captured images will be displayed in the table with timestamps indicating when each photo was taken.

8. To delete an individual image, click the delete button (trash can icon) in the table corresponding to the desired image.

9. To delete all images at once, click the "Delete All Images" button.

10. The remaining storage on the server will be displayed at the bottom of the page.

## Customize

- If you want to change the capture interval, open the `index.html` file and modify the `capturePhoto` function's timer interval (currently set to 5000 milliseconds).

- To customize the layout and appearance, you can modify the HTML and CSS code in the `index.html` file.

## License

This project is licensed under the [MIT License](LICENSE).


