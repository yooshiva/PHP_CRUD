<?php include 'dbconn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Student</title>
</head>
<body>
<div class="container mt-5">
    <h2>Update Student Information</h2>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM students WHERE id = '$id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <form action="edit.php?id=<?php echo $id; ?>" method="post">
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>">
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>">
        </div>
        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="<?php echo $row['age']; ?>">
        </div>
        <input type="submit" class="btn btn-success" name="update_student" value="Update">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<?php
// Handle the Update logic
if (isset($_POST['update_student'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];

    $update_query = "UPDATE students SET first_name = '$fname', last_name = '$lname', age = '$age' WHERE id = '$id'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        header('location:index.php?success=Updated Successfully');
    } else {
        echo "Update failed: " . mysqli_error($connection);
    }
}
?>
</body>
</html>