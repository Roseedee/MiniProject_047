<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "miniproject_047_db";

    $con = new mysqli($host, $username, $password, $dbname);

    if($con->connect_error) {
        die("Connection Failed : " . $con->connect_error);
    }
?>
