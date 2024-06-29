<?php
// Set the time zone to Sri Lanka (Asia/Colombo)
date_default_timezone_set('Asia/Colombo');

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
    echo "Backup created successfully: $backupFile";
} else {
    echo "Failed to create backup. Return code: $return_var";
}
?>
