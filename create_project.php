<?php
session_start();

// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user is authenticated

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_project"])) {
    // Retrieve project details from the form
    $projectName = $_POST['project_name'];
    $projectDescription = $_POST['project_description'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $managerId = $_POST['manager_id'];
    $projectId = $_POST['project_id'];
    $categoryId = $_POST['category_id'];
    $status=$_POST['status'];
   
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

    // Insert project details into the database
    $sql = "INSERT INTO project (project_name, project_description, start_date, end_date, manager_id, project_id, category_id,status ) 
            VALUES ('$projectName', '$projectDescription', '$startDate', '$endDate', '$managerId', '$projectId', '$categoryId','$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Project created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
