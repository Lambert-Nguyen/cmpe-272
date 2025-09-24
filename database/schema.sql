-- Database schema for the CMPE 272 PHP Application
-- This file contains the SQL statements to create the database structure

-- Create database (optional - may be created by Render)
-- CREATE DATABASE IF NOT EXISTS cmpe272_app;
-- USE cmpe272_app;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO users (username, email) VALUES 
('lam_nguyen', 'phuongduylam.nguyen@sjsu.edu'),
('prof_sinn', 'richard.sinn@sjsu.edu'),
('student1', 'student1@sjsu.edu')
ON DUPLICATE KEY UPDATE username=username;