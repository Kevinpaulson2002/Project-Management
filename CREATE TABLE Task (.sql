CREATE TABLE Task (
    task_id INT PRIMARY KEY,
    title VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    due_date DATE,
    priority VARCHAR(50),
    status VARCHAR(50),
    project_id INT,
    assigned_to INT,
    FOREIGN KEY (project_id) REFERENCES Project(project_id),
    FOREIGN KEY (assigned_to) REFERENCES User(user_id)
);

-- Insert sample data
INSERT INTO Task (task_id, title, description, due_date, priority, status, project_id, assigned_to) VALUES
(101, 'Task 1', 'Description for Task 1', '2023-01-15', 'High', 'In Progress', 201, 2),
(102, 'Task 2', 'Description for Task 2', '2023-02-01', 'Medium', 'Not Started', 202, 3),
(103, 'Task 3', 'Description for Task 3', '2023-03-10', 'Low', 'Completed', 201, 1);
