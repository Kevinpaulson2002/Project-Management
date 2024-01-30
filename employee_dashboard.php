<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" type="text/css" href="employee_dashboard.css">
</head>
<body>

    <?php
    // Assuming you have the username stored in a session variable
    session_start();
    $username = $_SESSION['username'];
    ?>

    <h2>Welcome, <?php echo $username; ?>!</h2>
    

    <div >
        <a  href="loginpage.html"><button id="adminlogout">LOGOUT</button></a>
    </div>
    <div class="employee-section">
        <h3>View Tasks</h3>
        <a href="view_tasks_employee.php" class="view-tasks-button">View Tasks</a>
    </div>

    <div class="employee-section">
        <h3>Update Status</h3>
        <form action="update_status.php" method="post">
            <label for="task_id">Task ID:</label>
            <input type="text" name="task_id" required>

            <label for="new_status">New Status:</label>
            <select name="new_status" required>
            <option value="In Progress">In Progress</option>
            <option value="Not Started">Not Started</option>
            <option value="Completed">Completed</option>
        </select>


            <button type="submit" name="update_status">Update Status</button>
        </form>
    </div>
    

</body>
</html>
