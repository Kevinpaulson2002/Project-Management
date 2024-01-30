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

        // Retrieve projects for the manager based on user_id
        $projectsQuery = "SELECT project_id, project_name, start_date, end_date
                          FROM project
                          WHERE manager_id = ?";
        $projectsStmt = $conn->prepare($projectsQuery);
        $projectsStmt->bind_param("i", $user_id);
        $projectsStmt->execute();
        $projectsResult = $projectsStmt->get_result();

        // Display projects
        if ($projectsResult->num_rows > 0) {
            echo "<h2>Projects Assigned to $username</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>";

            while ($row = $projectsResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['project_id']}</td>
                        <td>{$row['project_name']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No projects found for $username.";
        }

        $projectsStmt->close();
    } else {
        echo "User not found.";
    }

    $stmt->close();
} else {
    echo "User not authenticated.";
}

$conn->close();
?>
