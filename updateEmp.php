<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color:while;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: pink;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
<?php
include 'connection.php';

// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);

$Emp_id = $data['Emp_id'];
$Emp_name = $data['Emp_name'];
$profile = $data['profile'];
$phone = $data['phone'];

// Update the employee details in the database
$sql = "UPDATE employees SET Emp_name = ?, profile = ?, phone = ? WHERE Emp_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $Emp_name, $profile, $phone, $Emp_id);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    header('Location: mainEmo.php');
} else {
    $response['success'] = false;
}

// Send the response back to the JavaScript
echo json_encode($response);

$stmt->close();
$conn->close();
?>
;