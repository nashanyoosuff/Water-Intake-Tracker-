CREATE DATABASE IF NOT EXISTS water_tracker;
USE water_tracker;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE intake (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date DATE NOT NULL,
    amount INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);