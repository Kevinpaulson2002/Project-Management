<?php
// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user has the 'manager' role

session_start();


// Replace these credentials with your actual database connection details
$servername = "localhost";
$username = "newsqluser";
$password = "password";
$dbname = "project";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

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
        // Iterate through each project and fetch tasks
        while ($rowProjectIds = $resultProjectIds->fetch_assoc()) {
            $projectId = $rowProjectIds['project_id'];

            // Fetch tasks for each project
            $sqlTasks = "SELECT * FROM task WHERE project_id = '$projectId'";
            $resultTasks = $conn->query($sqlTasks);

            if ($resultTasks->num_rows > 0) {
                // Display tasks for the current project
                echo "<h2>Tasks for Project ID: $projectId</h2>";
                echo "<div class='manager-section'>";
                echo "<table>";
                echo "<tr><th>Task ID</th><th>Title</th><th>Description</th><th>Due Date</th><th>Priority</th><th>Status</th><th>Assigned To</th></tr>";
                while ($rowTasks = $resultTasks->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$rowTasks['task_id']}</td>";
                    echo "<td>{$rowTasks['title']}</td>";
                    echo "<td>{$rowTasks['description']}</td>";
                    echo "<td>{$rowTasks['due_date']}</td>";
                    echo "<td>{$rowTasks['priority']}</td>";
                    echo "<td>{$rowTasks['status']}</td>";
                    echo "<td>{$rowTasks['assigned_to']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>No tasks found for Project ID: $projectId</p>";
            }
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks (Manager)</title>
    <link rel="stylesheet" type="text/css" href="manager_dashboard.css">
    <style>
        /* Add a border to the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- Additional styling or content for the HTML page can be added here -->
</body>
</html>
