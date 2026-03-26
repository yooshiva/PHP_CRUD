<?php 
include 'dbconn.php'; 

if (isset($_POST['add_students'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

  
    $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$f_name', '$l_name', '$age')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        header('location:index.php?error=Query Failed: ' . mysqli_error($connection));
    } else {
        header('location:index.php?success=New student added successfully!');
    }
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .header-banner { background-color: #212529; color: white; padding: 3rem; margin-bottom: 1.5rem; text-align: center; }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="header-banner">CRUD APPLICATION USING PHP AND MYSQL</h1>

                <?php
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . htmlspecialchars($_GET['success']) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                }
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . htmlspecialchars($_GET['error']) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                }
                ?>

                <div class="d-flex justify-content-between mb-3">
                    <h3>All Students</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Create</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM students";
                            $result = mysqli_query($connection, $sql);

                            if(!$result){
                                die("<tr><td colspan='4' class='text-center text-danger'>Query failed: " . mysqli_error($connection) . "</td></tr>");
                            }

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                        <td><?php echo $row['age']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No students found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="studentModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="index.php" method="post"> <div class="modal-header">
              <h5 class="modal-title">Add New Student</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="f_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="l_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" name="add_students" value="ADD">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>