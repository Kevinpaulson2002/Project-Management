<?php
// Start the session
session_start();

// Replace these credentials with your actual database connection details
$servername = "localhost";
$username = "newsqluser";
$password = "password";
$dbname = "project";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the username from the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Retrieve tasks for the user based on user_id
        $tasksQuery = "SELECT task_id, title, description, status, due_date
                       FROM task
                       WHERE assigned_to = ?";
        $tasksStmt = $conn->prepare($tasksQuery);
        $tasksStmt->bind_param("i", $user_id);
        $tasksStmt->execute();
        $tasksResult = $tasksStmt->get_result();

        // Display tasks
        if ($tasksResult->num_rows > 0) {
            echo "<h2>Tasks for $username</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Task ID</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                    </tr>";

            while ($row = $tasksResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['task_id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['due_date']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No tasks found for $username.";
        }

        $tasksStmt->close();
    } else {
        echo "User not found.";
    }

    $stmt->close();
} else {
    echo "User not authenticated.";
}

$conn->close();
?>
