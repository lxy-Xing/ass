<?php
// Database connection
include 'connection.php';

// Fetch departments
$departmentSql = "SELECT id, name FROM department";
$DepartmentResult = $conn->query($departmentSql);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and escape input data
    $emp_name = $conn->real_escape_string($_POST['emp_Name']);
    $depart_id = $conn->real_escape_string($_POST['depart_id']);
    $profile = $conn->real_escape_string($_POST['profile']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Prepare and execute SQL statement
    $sql = "INSERT INTO employees (Department_id, Emp_name, profile, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $depart_id, $emp_name, $profile, $phone);

    if ($stmt->execute()) {
        // Redirect to mainEmp.php after successful insertion
        header("Location: index.php");
        exit();
    } else {
        // Output error message if insertion fails
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="emp_Name">Employee Name:</label>
                <input type="text" class="form-control" name="emp_Name" required>
            </div>
            <div class="form-group">
                <label for="depart_id">Department Name:</label>
                <select class="form-control" name="depart_id" required>
                    <option value="">Select Department</option>
                    <?php while($row = $DepartmentResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="profile">Profile:</label>
                <input type="text" class="form-control" name="profile" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" required>
            </div>
            <button type="submit" class="btn btn-primary">Add New Employee</button>
        </form>
    </div>
</body>
</html>
