<?php
    $host = "";
    $username = "";
    $password = "";
    $dbname = "";

    $con = new mysqli($host, $username, $password, $dbname);

    if($con->connect_error) {
        die("Connection Failed : " . $con->connect_error);
    }
?>
