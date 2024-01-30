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

// Check if the user is authenticated and has the necessary permissions (add additional checks if needed)

    if (isset($_POST['update_status'])) {
        $task_id = $_POST['task_id'];
        $new_status = $_POST['new_status'];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE task SET status = ? WHERE task_id = ?");
        $stmt->bind_param("si", $new_status, $task_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Form not submitted.";
    }
 

// Close the connection
$conn->close();
?>
