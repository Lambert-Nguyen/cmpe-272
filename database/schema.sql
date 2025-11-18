-- Database schema for the CMPE 272 PHP Application
-- This file contains the SQL statements to create the database structure

-- Create database (optional - may be created by Render)
-- CREATE DATABASE IF NOT EXISTS cmpe272_app;
-- USE cmpe272_app;

-- Users table (Marketplace-wide shared users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products table (All marketplace products from all companies)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    category VARCHAR(100),
    company_name VARCHAR(100) NOT NULL,
    company_url VARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_company (company_url),
    INDEX idx_category (category)
);

-- Reviews table (Users can review any product from any company)
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id),
    INDEX idx_product (product_id),
    INDEX idx_user (user_id),
    INDEX idx_rating (rating)
);

-- Product visits table (Track visits across all marketplace companies)
CREATE TABLE IF NOT EXISTS product_visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT,
    ip_address VARCHAR(45),
    visited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_product (product_id),
    INDEX idx_user (user_id),
    INDEX idx_visited_at (visited_at)
);

-- Wishlists table (Users can favorite products)
CREATE TABLE IF NOT EXISTS wishlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id),
    INDEX idx_user (user_id)
);

-- Insert sample users with passwords (password is 'password123' hashed with PASSWORD_DEFAULT)
INSERT INTO users (username, email, password) VALUES
('lam_nguyen', 'phuongduylam.nguyen@sjsu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('prof_sinn', 'richard.sinn@sjsu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('student1', 'student1@sjsu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('demo_user', 'demo@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE username=username;

-- Insert sample products from Lambert Nguyen Company
INSERT INTO products (name, description, price, category, company_name, company_url) VALUES
('Custom Web Application Development', 'Full-stack web development services using modern frameworks and technologies. We build scalable, secure, and user-friendly applications tailored to your business needs.', 15000.00, 'Web Development', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('Cloud Migration & Deployment', 'Seamless migration of your applications to cloud platforms (AWS, Azure, GCP). Includes architecture review, migration strategy, and deployment automation.', 12000.00, 'Cloud Services', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('Mobile App Development', 'Native and cross-platform mobile application development for iOS and Android. Transform your ideas into powerful mobile experiences.', 20000.00, 'Mobile Development', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('AI & Machine Learning Solutions', 'Custom AI/ML solutions including predictive analytics, natural language processing, and computer vision applications.', 25000.00, 'AI/ML', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('Enterprise Resource Planning (ERP)', 'Comprehensive ERP systems to streamline your business operations, from inventory management to customer relationship management.', 30000.00, 'Enterprise Software', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('E-Commerce Platform Development', 'Build robust online stores with payment integration, inventory management, and analytics. Perfect for retail and B2B businesses.', 18000.00, 'E-Commerce', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('Cybersecurity & Penetration Testing', 'Protect your digital assets with comprehensive security audits, penetration testing, and vulnerability assessments.', 10000.00, 'Security', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('DevOps & CI/CD Implementation', 'Automate your software delivery pipeline with modern DevOps practices, continuous integration, and deployment strategies.', 14000.00, 'DevOps', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('Data Analytics & Business Intelligence', 'Transform raw data into actionable insights with custom dashboards, reporting tools, and predictive analytics.', 16000.00, 'Data Analytics', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud'),
('API Development & Integration', 'Design and develop RESTful APIs, GraphQL services, and integrate third-party services seamlessly into your applications.', 8000.00, 'API Services', 'Lambert Nguyen Company', 'https://lambertnguyen.cloud');

-- Insert sample products from TechPro Solutions (Teammate #1)
INSERT INTO products (name, description, price, category, company_name, company_url) VALUES
('Enterprise Software Solutions', 'Comprehensive enterprise-grade software solutions designed to scale with your business. From CRM to inventory management.', 22000.00, 'Enterprise Software', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('Database Optimization Services', 'Improve database performance with query optimization, indexing strategies, and architecture reviews. Support for MySQL, PostgreSQL, and MongoDB.', 9000.00, 'Database Services', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('Custom CRM Development', 'Tailored Customer Relationship Management systems to help you manage leads, sales pipeline, and customer interactions effectively.', 17000.00, 'CRM', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('IT Consulting Services', 'Expert technology consulting to help you make informed decisions about your IT infrastructure and software investments.', 5000.00, 'Consulting', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('Legacy System Modernization', 'Upgrade and modernize your legacy applications with modern technologies while preserving critical business logic.', 28000.00, 'Modernization', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('Microservices Architecture', 'Transform monolithic applications into scalable microservices architecture for better performance and maintainability.', 24000.00, 'Architecture', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('Blockchain Development', 'Develop secure blockchain solutions, smart contracts, and decentralized applications for various industries.', 35000.00, 'Blockchain', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com'),
('IoT Solutions', 'Connect and manage IoT devices with custom platforms, real-time monitoring, and data analytics.', 21000.00, 'IoT', 'TechPro Solutions', 'https://php-mysql-hosting-project.onrender.com');

-- Insert sample products from PureBite Beauty (Teammate #2)
INSERT INTO products (name, description, price, category, company_name, company_url) VALUES
('Organic Face Serum', 'Luxurious anti-aging face serum made with 100% organic ingredients. Reduce fine lines and restore your skin natural glow.', 89.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Natural Hair Care Kit', 'Complete hair care solution with organic shampoo, conditioner, and hair mask. Sulfate-free and paraben-free.', 129.99, 'Hair Care', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Vitamin C Brightening Cream', 'Brighten and even out skin tone with our powerful Vitamin C formula. Perfect for daily use on all skin types.', 64.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Organic Makeup Remover', 'Gentle yet effective makeup remover made with natural oils. Removes even waterproof makeup without harsh chemicals.', 34.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Rejuvenating Eye Cream', 'Reduce dark circles, puffiness, and fine lines around the eyes with this nourishing organic eye cream.', 54.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Hydrating Body Butter', 'Rich and creamy body butter infused with shea butter and essential oils. Deep moisturization for dry skin.', 44.99, 'Body Care', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Natural Lip Care Set', 'Keep your lips soft and hydrated with our organic lip balm and lip scrub duo. Available in multiple flavors.', 24.99, 'Lip Care', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Anti-Acne Treatment Kit', 'Combat acne naturally with tea tree oil, salicylic acid, and other organic ingredients. Suitable for sensitive skin.', 79.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Detoxifying Clay Mask', 'Deep cleanse and detoxify your skin with our mineral-rich clay mask. Removes impurities and tightens pores.', 39.99, 'Skincare', 'PureBite Beauty', 'https://anukrithimyadala.42web.io'),
('Essential Oils Collection', 'Premium collection of 10 pure essential oils including lavender, eucalyptus, and peppermint. Perfect for aromatherapy.', 99.99, 'Wellness', 'PureBite Beauty', 'https://anukrithimyadala.42web.io');