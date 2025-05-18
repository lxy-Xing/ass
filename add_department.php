<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emp_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Name = $_POST['Name'];
    $discition = $_POST['description'];
    

    $sql = "INSERT INTO department (name,description) VALUES ('$Name', '$discition')";

    if ($conn->query($sql) === TRUE) {
         header("Location:index.php");
         exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Department</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Department Name:</label>
                <input type="text" class="form-control" name="Name" required>
            </div>
          
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">Add New Department</button>
        </form>
    </div>
</body>
</html>
