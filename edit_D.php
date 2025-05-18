<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emp_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data based on the ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM department WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $D = $result->fetch_assoc();
    } else {
        echo "No user found!";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $Description = $_POST['description'];
    

    $sql = "UPDATE department SET name='$name',description='$Description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
         header("Location:D_Emp.php"); 
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color:  #de5bb9;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: purple;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h2 class="text-center">Department Update</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $D['id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $D['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" required><?php echo $D['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
