<?php
// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user has the 'manager' role

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

// Get manager's user_id from the session variable
$managerUsername = $_SESSION['username'];

// Find user_id from the user table based on the username
$sqlUserId = "SELECT user_id FROM user WHERE username = '$managerUsername'";
$resultUserId = $conn->query($sqlUserId);

if ($resultUserId->num_rows > 0) {
    $rowUserId = $resultUserId->fetch_assoc();
    $managerId = $rowUserId['user_id'];

    // Get manager's project IDs
    $sqlProjectIds = "SELECT project_id FROM project WHERE manager_id = '$managerId'";
    $resultProjectIds = $conn->query($sqlProjectIds);

    if ($resultProjectIds->num_rows > 0) {
        // Iterate through each project and remove completed tasks
        while ($rowProjectIds = $resultProjectIds->fetch_assoc()) {
            $projectId = $rowProjectIds['project_id'];

            // Remove completed tasks for each project
            $sqlRemoveTasks = "DELETE FROM task WHERE project_id = '$projectId' AND status = 'Completed'";
            $conn->query($sqlRemoveTasks);

            echo "<p>Completed tasks removed for Project ID: $projectId</p>";
        }
    } else {
        echo "<p>No projects found for Manager ID: $managerId</p>";
    }
} else {
    echo "<p>User not found with username: $managerUsername</p>";
}

// Close the database connection
$conn->close();
?>
