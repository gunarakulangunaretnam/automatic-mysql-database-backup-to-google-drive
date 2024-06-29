<?php
// Set the time zone to Sri Lanka (Asia/Colombo)
date_default_timezone_set('Asia/Colombo');

// Include Google API PHP Client library autoload.php
require __DIR__ . '/vendor/autoload.php';

// Use statements for Google API classes
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

// Database configuration
$host = 'localhost';
$dbname = 'DATABASE_NAME';
$username = 'USERNAME';
$password = 'PASSWORD';

// Get the current timestamp in the desired format
$timestamp = date("d-m-Y-H-i-s");

// Define the backup file name
$backupFile = __DIR__ . "/backup-$timestamp.sql";

// Command to backup the database
$command = "mysqldump --user=$username --password=$password --host=$host $dbname > $backupFile";

// Execute the command and check if the backup was successful
exec($command, $output, $return_var);

if ($return_var === 0) {
    echo "Backup created successfully: $backupFile\n";

    // Path to the JSON file containing service account credentials
    define('SERVICE_ACCOUNT_FILE', 'ADD_SERVICE_ACCOUNT_AUTH_KEY.json');

    // ID of the Google Drive folder where you want to upload the file
    define('DRIVE_FOLDER_ID', 'ADD_GOOGLE_DRIVE_FOLDER_ID');

    // Function to upload file to Google Drive
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
        $fileMetadata->setName(basename($file_path));
        $fileMetadata->setParents(array(DRIVE_FOLDER_ID));

        // Define the file path to upload
        $fileContent = file_get_contents($file_path);

        // Upload the file
        $file = $service->files->create($fileMetadata, array(
            'data' => $fileContent,
            'mimeType' => 'application/sql', // Adjust MIME type if needed
            'uploadType' => 'multipart'
        ));

        printf("File uploaded successfully. File ID: %s\n", $file->getId());
    }

    // Upload the backup file
    uploadFile($backupFile);

    // Delete the backup file after uploading
    if (file_exists($backupFile)) {
        unlink($backupFile);
        echo "Backup file deleted from server.\n";
    } else {
        echo "Backup file not found on server.\n";
    }

} else {
    echo "Failed to create backup. Return code: $return_var\n";
}
?>
