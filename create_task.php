<?php
// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user has the necessary role

session_start();



// Replace these credentials with your actual database connection details
$dbHost = "localhost";
$dbUser = "newsqluser";
$dbPassword = "password";
$dbName = "project";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['create_task'])) {
    // Retrieve form data
    $taskId=$_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $projectId = $_POST['project_id'];
    $assignedTo = $_POST['assigned_to'];

    // Insert new task into the task table
    $sql = "INSERT INTO task (task_id,title, description, due_date, priority, status, project_id, assigned_to)
            VALUES ('$taskId','$title', '$description', '$dueDate', '$priority', '$status', '$projectId', '$assignedTo')";

    if ($conn->query($sql) === TRUE) {
        echo "Task created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

