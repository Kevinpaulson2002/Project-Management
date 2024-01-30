CREATE TABLE Employee (
    employee_id INT PRIMARY KEY,
    user_id INT UNIQUE,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    department VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

-- Insert sample data
INSERT INTO Employee (employee_id, user_id, first_name, last_name, department) VALUES
(1, 1, 'Alice', 'John', 'Development'),
(2, 2, 'Bob', 'M', 'Development'),
(3, 3, 'Charlie', 'W', 'QA');
