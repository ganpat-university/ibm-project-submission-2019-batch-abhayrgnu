<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'dac';
    $port = 3306;
    $con = mysqli_connect(
        $host,
        $user,
        $password,
        $dbname,
        $port
    );
    if (!$con) {
        echo "Connection to the database failed";
    } 
?>