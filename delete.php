<?php
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM students WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header('location:index.php?success=Record Deleted Successfully');
    } else {
        header('location:index.php?error=Delete Failed: ' . mysqli_error($connection));
    }
}
?>