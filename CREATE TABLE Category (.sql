CREATE TABLE Category (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(255) UNIQUE
);

-- Insert sample data
INSERT INTO Category (category_id, category_name) VALUES
(1, 'Category A'),
(2, 'Category B'),
(3, 'Category C');
