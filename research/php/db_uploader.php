<?php

require __DIR__ . '/vendor/autoload.php'; // Path to autoload.php from Google API PHP Client library

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Psr7;

// Path to the JSON file containing service account credentials
define('SERVICE_ACCOUNT_FILE', 'ADD_SERVICE_ACCOUNT_AUTH_KEY.json');

// ID of the Google Drive folder where you want to upload the file
define('DRIVE_FOLDER_ID', 'ADD_GOOGLE_DRIVE_FOLDER_ID');

function uploadFile($file_path)
{
    // Initialize the Google Client
    $client = new Google\Client();
    $client->setApplicationName('Drive API PHP Upload');
    $client->setScopes(Google\Service\Drive::DRIVE);
    $client->setAuthConfig(SERVICE_ACCOUNT_FILE);
    $client->setAccessType('offline');

    // Authorize using the service account credentials
    $client->useApplicationDefaultCredentials();

    // Initialize the Drive service
    $service = new Google\Service\Drive($client);

    // Create file metadata
    $fileMetadata = new DriveFile();
    $fileMetadata->setName('example_file.txt');
    $fileMetadata->setParents(array(DRIVE_FOLDER_ID));

    // Define the file path to upload
    $fileContent = file_get_contents($file_path);

    // Upload the file
    $file = $service->files->create($fileMetadata, array(
        'data' => $fileContent,
        'mimeType' => 'text/plain',
        'uploadType' => 'multipart'
    ));

    printf("File uploaded successfully. File ID: %s\n", $file->getId());
}

// Check if a file was uploaded via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file_path = $_FILES["file"]["tmp_name"]; // Adjust according to your form file input name
    uploadFile($file_path);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload to Google Drive</title>
</head>
<body>
    <h2>Upload a File to Google Drive</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload File</button>
    </form>
</body>
</html>
