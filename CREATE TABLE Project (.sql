CREATE TABLE Project (
    project_id INT PRIMARY KEY,
    project_name VARCHAR(255) UNIQUE NOT NULL,
    project_description TEXT,
    start_date DATE,
    end_date DATE,
    manager_id INT,
    category_id INT,
    FOREIGN KEY (manager_id) REFERENCES User(user_id),
    FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

-- Insert sample data
INSERT INTO Project (project_id, project_name, project_description, start_date, end_date, manager_id, category_id) VALUES
(201, 'Project Alpha', 'Description for Project Alpha', '2023-01-01', '2023-03-31', 1, 1),
(202, 'Project Beta', 'Description for Project Beta', '2023-02-15', '2023-04-30', 1, 2),
(203, 'Project Gamma', 'Description for Project Gamma', '2023-03-10', '2023-05-15', 1, 1);
