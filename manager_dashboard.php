<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" type="text/css" href="manager_dashboard.css">
</head>
<body>

    <?php
    // Assuming you have the username stored in a session variable
    session_start();
    $username = $_SESSION['username'];
    ?>

    <h2>Welcome, <?php echo $username; ?>!</h2>

    <!--LOGOUT BUTTON IN RED colour-->
    <div >
        <a  href="loginpage.html"><button id="adminlogout">LOGOUT</button></a>
    </div>
    <div class="manager-section">
        <h3>Create Task</h3>
        <form action="create_task.php" method="post">
            <label for="task_id">Task ID:</label>
            <input type="text" name="task_id" required>


            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" required>

            <label for="priority">Priority:</label>
            <select name="priority" required>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="In Progress">In Progress</option>
                <option value="Not Started">Not Started</option>
                <option value="Completed">Completed</option>
            </select>

            <label for="project_id">Project ID:</label>
            <input type="text" name="project_id" required>

            <label for="assigned_to">Assigned To:</label>
            <input type="text" name="assigned_to" required>

            <button type="submit" name="create_task">Create Task</button>
        </form>
    </div>

    <div class="manager-section">
        <h3>View Tasks For Your Projects</h3>
        <a href="view_tasks_manager.php" class="view-tasks-button">View Tasks For Your Projects</a>
    </div>

    <div class="manager-section">
        <h3>View Your Projects</h3>
        <a href="view_projects_manager.php" class="view-projects-button">View Your Projects</a>
    </div>

    <div class="manager-section">
        <h3>Remove Completed Task</h3>
        <a href="remove_tasks.php" class="view-projects-button">Remove Completed Tasks</a>
    </div>

    <div class="manager-section">
        <h3>View all Tasks</h3>
        <a href="view_tasks.php" class="view-tasks-button">View all tasks</a>
    </div>

    <div class="manager-section">
        <h3>View Employees</h3>
        <a href="view_employee_manager.php" class="view-tasks-button">View Employees</a>
    </div>

</body>
</html>
