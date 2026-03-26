<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'student_crud');

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$connection){
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($connection, "utf8mb4");
?>