<?php
session_start();

// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user is authenticated

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    // Retrieve user details from the form
    $userId = $_POST['user_id'];
    $username = $_POST['new_username'];
    $email = $_POST['email'];
    $password = $_POST['new_password'];
    $role = $_POST['new_role'];

    // Perform additional validation and sanitation as needed

    // Connect to the database
    $dbHost = "localhost";
    $dbUser = "newsqluser";
    $dbPassword = "password";
    $dbName = "project";
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user details into the database
    $sql = "INSERT INTO user (user_id, username, email, password, role) 
            VALUES ('$userId', '$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
