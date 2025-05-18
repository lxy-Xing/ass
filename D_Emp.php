<?php
    include 'connection.php';

    $sql = "SELECT * FROM department";
          

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
    <link rel="stylesheet" href="styleD.css"> 
</head>
<body>
    <div class="container">
        <h2 class="text-center">Department List</h2>
        <a href="index.php" class=" btn-home "><i class="fas fa-home"></i></a>
        <a href="add_department.php" class="btn btn-custom mb-3">Add Department</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        // echo "<td>" . $row["profile"] . "</td>";
                        // echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>";
                            echo "<a href='edit_D.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a> ";
                           
                            echo "<a href='delete_D.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirmDelete()'>Delete</a>";
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


  
   

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Department?");
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
