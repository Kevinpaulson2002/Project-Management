<?php
session_start();

// Place any authentication logic here to ensure only authorized users can access this page
// For example, you can use sessions and check if the user is authenticated

// Connect to the database
$dbHost = "localhost";
$dbUser = "newsqluser";
$dbPassword = "password";
$dbName = "project";
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the joined tables, selecting only necessary columns and ordering by category_id
$sql = "SELECT project.project_id, project.project_name, category.category_name
        FROM project
        JOIN category ON project.category_id = category.category_id
        ORDER BY category.category_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Category</title>
    <link rel="stylesheet" type="text/css" href="admin_dashboard.css">
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

    <h2>View Category</h2>

    <div class="admin-section">
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Category Name</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['project_id']; ?></td>
                        <td><?php echo $row['project_name']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No data found.</p>
        <?php endif; ?>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
