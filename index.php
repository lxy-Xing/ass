<?php
    include 'connection.php';

    $sql = "SELECT employees.*, department.name AS department_name
            FROM employees
            INNER JOIN department ON department.id = employees.Department_id";

    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container">
        <h2 class="text-center">Employee List</h2>
        <a href="insertEmp.php" class="btn btn-custom mb-3">Add New</a>
        <a href="add_department.php" class="btn btn-custom mb-3">Add Department</a>
        <a href="D_Emp.php" class="btn btn-custom mb-3">View Department</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Employee Name</th>
                    <th>Profile</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["department_name"] . "</td>";
                        echo "<td>" . $row["Emp_name"] . "</td>";
                        echo "<td>" . $row["profile"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>";
                            echo "<a href='editEmp.php?id=" . $row["Emp_id"] . "' class='btn btn-edit'>Edit</a> ";
                            echo "<a href='deleteEmp.php?id=" . $row["Emp_id"] . "' class='btn btn-delete' onclick='return confirmDelete()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No employees found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    

    <!-- jQuery -->
   

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this employee?");
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
