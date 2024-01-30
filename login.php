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

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, username, role FROM User WHERE username=? AND password=? AND role=?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username, $role);
        $stmt->fetch();

        // Store username in a session variable
        $_SESSION['username'] = $username;

        // Redirect to the appropriate page based on the user's role
        switch ($role) {
            case 'admin':
                header("Location: admin_dashboard.html");
                break;
            case 'manager':
                header("Location: manager_dashboard.php");
                break;
            case 'employee':
                header("Location: employee_dashboard.php");
                break;
            default:
                // Handle other roles or scenarios as needed
                break;
        }
        exit();
    } else {
        echo "Invalid login credentials. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
