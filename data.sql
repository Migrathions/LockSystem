CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    question VARCHAR(255),
    answer VARCHAR(255),
    status VARCHAR(20) DEFAULT 'ongoing'
);
