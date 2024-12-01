CREATE TABLE Employee (
    employee_id INT AUTO_INCREMENT PRIMARY KEY, 
    last_name VARCHAR(100) NOT NULL,        
    first_name VARCHAR(100) NOT NULL,       
    position VARCHAR(100) NOT NULL,      
    major_subject VARCHAR(100) NOT NULL      
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE Employee
ADD COLUMN date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL;


INSERT INTO Employee (last_name, first_name, position, major_subject) VALUES
('Smith', 'John', 'Software Engineer', 'Computer Science'),
('Doe', 'Jane', 'Data Analyst', 'Statistics'),
('Brown', 'James', 'System Administrator', 'Information Technology'),
('Taylor', 'Emily', 'Network Engineer', 'Computer Networking'),
('Wilson', 'Michael', 'Web Developer', 'Web Design'),
('Davis', 'Sarah', 'Database Administrator', 'Database Management'),
('Anderson', 'Robert', 'Project Manager', 'Business Management'),
('Thomas', 'Patricia', 'UX Designer', 'Human-Computer Interaction'),
('Jackson', 'Christopher', 'Mobile Developer', 'Mobile Computing'),
('White', 'Laura', 'Cybersecurity Specialist', 'Cybersecurity'),
('Harris', 'David', 'DevOps Engineer', 'Software Engineering'),
('Martin', 'Elizabeth', 'AI Specialist', 'Artificial Intelligence'),
('Thompson', 'Daniel', 'Cloud Engineer', 'Cloud Computing'),
('Garcia', 'Sophia', 'IT Support Specialist', 'Information Technology'),
('Martinez', 'Joseph', 'Game Developer', 'Game Design');
