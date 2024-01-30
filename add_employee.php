<?php
session_start();

// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user is authenticated

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_employee"])) {
    // Retrieve employee details from the form
    $employeeId = $_POST['employee_id'];
    $userId = $_POST['user_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $department = $_POST['department'];

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

    // Insert employee details into the database
    $sql = "INSERT INTO employee (employee_id, user_id, first_name, last_name, department) 
            VALUES ('$employeeId', '$userId', '$firstName', '$lastName', '$department')";

    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
