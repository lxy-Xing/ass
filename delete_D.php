<?php
// Database connection
include 'connection.php';

// Check if 'id' is present in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete the user
    $sql = "DELETE FROM department WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: D_Emp.php"); // Redirect to the user management page after deletion
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided";
}

$conn->close();
?>
;
