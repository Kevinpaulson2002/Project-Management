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

// Join user and employee tables based on user_id
$sql = "SELECT user.user_id, employee.first_name, employee.last_name, user.role
        FROM user
        
        JOIN employee ON user.user_id = employee.user_id
        WHERE user.role = 'employee'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees (Manager)</title>
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

    <h2>View Employees</h2>

    <div class="manager-section">
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No employees found.</p>
        <?php endif; ?>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
