<?php
// set_time_limit(5);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ftp_server = "ftpdemo1.yetmet.net";
$ftp_username = "ftpdemo1";
$ftp_userpass = "fqxS556#dAti4&94";

// Establishing ftp connection
$ftp_connection = ftp_connect($ftp_server)
    or die("Could not connect to $ftp_server");

if ($ftp_connection) {
    echo "successfully connected to the ftp server!";
    $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);

    if ($login) {
        echo "<br>logged in successfully!";
        ftp_pasv($ftp_connection, true);

        // change the current directory to php
        // $file_list1 = ftp_chdir($ftp_connection, "folder");
        // $file_list = ftp_nlist($ftp_connection, ".");

		
        $uniqueKey = "code";
		$sourceDirectory = "C:/xampp/htdocs/" . $uniqueKey;
		$targetDirectory = "/folder";
        var_dump(uploadToServer($sourceDirectory,$targetDirectory,$ftp_connection));
    } else {
        echo "<br>login failed!";
    }

    // echo ftp_get_option($ftp_connection, 1);
    // Closing connection
    if (ftp_close($ftp_connection)) {
        echo "<br>Connection closed Successfully!";
    }
}


function uploadToServer($sourceDirectory, $targetDirectory, $ftp_connection)
{
    $dirContents = scandir($sourceDirectory);
    foreach ($dirContents as $row) {
        if ($row == '.' || $row == '..')
            continue;
        if (is_dir($sourceDirectory . "/" . $row)) {
            ftp_mkdir($ftp_connection, $targetDirectory . "/" . $row);
            uploadToServer($sourceDirectory . "/" . $row, $targetDirectory . "/" . $row, $ftp_connection);
        } else {
            $file = $sourceDirectory . "/" . $row;
            ftp_put($ftp_connection, $targetDirectory . "/" . $row, $file, FTP_BINARY);
        }
    }
}


?>