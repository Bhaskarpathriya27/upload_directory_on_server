<?php 

$host = "";
if(isset($_POST['host']) && !empty($_POST['host']))
{
    $host = $_POST['host'];
}
else {
    echo "Please enter Host Details";
    die;
}

$username = "";
if(isset($_POST['username']) && !empty($_POST['username']))
{
    $username = $_POST['username'];
}
else {
    echo "Please enter username Details";
    die;
}

$password = "";
if(isset($_POST['password']) && !empty($_POST['password']))
{
    $password = $_POST['password'];
}
else {
    echo "Please enter password Details";
    die;
}

$local = "";
if(isset($_POST['local']) && !empty($_POST['local']))
{
    $local = $_POST['local'];
}
else {
    echo "Please enter Source Details";
    die;
}

$serverAdd = "";
if(isset($_POST['serverAdd']) && !empty($_POST['serverAdd']))
{
    $serverAdd = $_POST['serverAdd'];
}
else {
    echo "Please enter Require Details";
    die;
}

$ftp_server = $host;
$ftp_username = $username;
$ftp_userpass = $password;


// Establishing ftp connection
$ftp_connection = ftp_ssl_connect($ftp_server)
    or die("Could not connect to $ftp_server");

if ($ftp_connection) {
    echo "successfully connected to the ftp server!";
    $login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);

    if ($login) {
        echo "<br>logged in successfully!";
        ftp_pasv($ftp_connection, true);

        // change the current directory to php
        $file_list1 = ftp_chdir($ftp_connection, "/public_html");
        $file_list = ftp_nlist($ftp_connection, ".");
        // var_dump($file_list);
        // output the array stored in $file_list using foreach loop
        //  foreach ($file_list as $key => $dat) {
        //      echo $key . "=>" . $dat . "<br>";
        //  }

		
        $uniqueKey = $local;
		$sourceDirectory = "C:/xampp/htdocs/" . $uniqueKey;
		$targetDirectory = $serverAdd;
        var_dump(uploadToServer($sourceDirectory,$targetDirectory,$ftp_connection));
    } else {
        echo "<br>login failed!";
    }

    // echo ftp_get_option($ftp_connection, 1);
    // Closing connection
    if (ftp_close($ftp_connection)) {
        echo "<br>Connection closed Successfully!";
        exit();
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