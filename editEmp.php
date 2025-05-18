<?php
// Database connection
include 'connection.php';

// Fetch departments for the dropdown
$departmentSql = "SELECT id, name FROM department";
$DepartmentResult = $conn->query($departmentSql);

// Fetch existing employee data if ID is provided
$emp_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$employee = null;

if ($emp_id) {
    $sql = "SELECT * FROM employees WHERE Emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and escape input data
    $emp_id = $conn->real_escape_string($_POST['Emp_id']);
    $emp_name = $conn->real_escape_string($_POST['emp_Name']);
    $depart_id = $conn->real_escape_string($_POST['depart_id']);
    $profile = $conn->real_escape_string($_POST['profile']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Prepare and execute SQL statement
    $sql = "UPDATE employees SET Department_id = ?, Emp_name = ?, profile = ?, phone = ? WHERE Emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $depart_id, $emp_name, $profile, $phone, $emp_id);

    if ($stmt->execute()) {
        // Redirect to mainEmp.php after successful update
        header("Location: index.php");
        exit();
    } else {
        // Output error message if update fails
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
    <title>Update Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Employee</h2>
        <form action="" method="post">
            <input type="hidden" name="Emp_id" value="<?php echo htmlspecialchars($employee['Emp_id'] ?? ''); ?>">
            <div class="form-group">
                <label for="emp_Name">Employee Name:</label>
                <input type="text" class="form-control" name="emp_Name" value="<?php echo htmlspecialchars($employee['Emp_name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="depart_id">Department Name:</label>
                <select class="form-control" name="depart_id" required>
                    <option value="">Select Department</option>
                    <?php while($row = $DepartmentResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>" <?php echo ($row['id'] == $employee['Department_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="profile">Profile:</label>
                <input type="text" class="form-control" name="profile" value="<?php echo htmlspecialchars($employee['profile'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($employee['phone'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
</body>
</html>
