CREATE TABLE User (
    user_id INT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);

-- Insert sample data
INSERT INTO User (user_id, username, email, password, role) VALUES
(1, 'alice', 'alice@email.com', 'password1', 'manager'),
(2, 'bob', 'bob@email.com', 'password2', 'employee'),
(3, 'charlie', 'charlie@email.com', 'password3', 'employee'),
(4, 'admin1', 'admin@email.com', 'adminpass', 'admin');
