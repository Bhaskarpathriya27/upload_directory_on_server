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
        $file_list1 = ftp_chdir($ftp_connection, "folder");
        $file_list = ftp_nlist($ftp_connection, ".");
        // $file = "C:/xampp/htdocs/demo.php";
        // $demo = ftp_put($ftp_connection, '/folder/demo2.php', $file, FTP_BINARY);
        // var_dump($demo);

        // var_dump($file_list);
        // // output the array stored in $file_list using foreach loop
        // foreach ($file_list as $key => $dat) {
        //     echo $key . "=>" . $dat . "<br>";
        // }
        $uniqueKey = "code";
		$sourceDirectory = "C:/xampp/htdocs/" . $uniqueKey;
		$targetDirectory = "/folder";
        var_dump(uploadToServer($sourceDirectory,$targetDirectory,$ftp_connection));

        // $it = new RecursiveTreeIterator(new RecursiveDirectoryIterator("C:/xampp/htdocs/code", RecursiveDirectoryIterator::SKIP_DOTS));
        // foreach ($it as $path) {
        //     echo $path . "<br>";
        // }
    } else {
        echo "<br>login failed!";
    }

    // echo ftp_get_option($ftp_connection, 1);
    // Closing connection
    if (ftp_close($ftp_connection)) {
        echo "<br>Connection closed Successfully!";
    }
}

// function uploadToServer($uniqueKey, $ftp_connection)
// {
//     $directory = "C:/xampp/htdocs/" . $uniqueKey;
//     $dirContents = scandir($directory);
//     foreach ($dirContents as $row) {
//         if ($row == '.' || $row == '..')
//             continue;
//         if (is_dir($directory . "/" . $row)) {
//             ftp_mkdir($ftp_connection, "/" . $row);
//             uploadToServer($uniqueKey . "/" . $row, $ftp_connection);
//         } else {
//             $file = $directory . "/" . $row;
//             ftp_put($ftp_connection, "/" . $row, $file, FTP_BINARY);
//         }
//     }
// }


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



// function getFolderFileCount($uniqueKey)
// {
//     $totalCount = 0;
//     $directory = "C:/xampp/htdocs/" . $uniqueKey;
//     $dirContents = scandir($directory);
//     foreach ($dirContents as $row) {
//         if ($row == '.' || $row == '..')
//             continue;
//         if (is_dir($directory . "/" . $row)) {
//             echo $row . " (directory)<br>";
//             $totalCount += getFolderFileCount($uniqueKey . "/" . $row);
//             $totalCount++;
//         } else {
//             echo $row . " (file)<br>";
//             $totalCount++;
//         }
//     }
//     return $totalCount;
// }


?>