<?php
    $host = "localhost";
    $username = "id20223495_roseedee";
    $password = "S-]8?fO(~\G[(Wl<";
    $dbname = "id20223495_miniproject047";

    $con = new mysqli($host, $username, $password, $dbname);

    if($con->connect_error) {
        die("Connection Failed : " . $con->connect_error);
    }
?>