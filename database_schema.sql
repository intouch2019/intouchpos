-- DreamsPOS Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS dreampos_db;
USE dreampos_db;

-- Users table for authentication
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'manager', 'cashier') DEFAULT 'cashier',
    is_active BOOLEAN DEFAULT TRUE,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    category_id INT,
    sku VARCHAR(50) UNIQUE,
    barcode VARCHAR(100),
    price DECIMAL(10,2) NOT NULL,
    cost_price DECIMAL(10,2),
    stock_quantity INT DEFAULT 0,
    min_stock_level INT DEFAULT 5,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Customers table
CREATE TABLE customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    customer_id INT,
    payment_method ENUM('cash', 'card', 'mobile_money') DEFAULT 'cash',
    subtotal DECIMAL(10,2) NOT NULL,
    tax_amount DECIMAL(10,2) DEFAULT 0,
    discount_amount DECIMAL(10,2) DEFAULT 0,
    total_amount DECIMAL(10,2) NOT NULL,
    notes TEXT,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'completed',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Order items table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert default admin user
INSERT INTO users (username, email, password, full_name, role) VALUES 
('admin', 'admin@dreampos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin');

-- Insert sample categories
INSERT INTO categories (name, description) VALUES 
('All', 'All Products'),
('Headset', 'Audio and communication devices'),
('Shoes', 'Footwear collection'),
('Mobiles', 'Mobile phones and accessories'),
('Watches', 'Timepieces and smartwatches'),
('Laptops', 'Computers and laptops'),
('Appliance', 'Home appliances');

-- Insert sample products
INSERT INTO products (name, description, category_id, sku, price, cost_price, stock_quantity, image) VALUES 
('iPhone 14 64GB', 'Apple iPhone 14 with 64GB storage', 5, 'IP14-64GB', 15800.00, 14000.00, 25, 'pos-product-01.png'),
('Samsung Galaxy S23', 'Samsung Galaxy S23 smartphone', 5, 'SG-S23', 12500.00, 11000.00, 30, 'pos-product-15.png'),
('Nike Air Max', 'Nike Air Max running shoes', 4, 'NK-AIRMAX', 8500.00, 6000.00, 50, 'pos-product-04.png'),
('Apple Watch Series 8', 'Apple Watch Series 8 smartwatch', 6, 'AW-S8', 9500.00, 8000.00, 15, 'pos-product-03.png'),
('MacBook Pro 13"', 'Apple MacBook Pro 13 inch laptop', 7, 'MBP-13', 45000.00, 38000.00, 10, 'pos-product-12.png'),
('Sony WH-1000XM4', 'Sony noise cancelling headphones', 3, 'SNY-WH1000', 12000.00, 10000.00, 20, 'pos-product-08.png'),
('Dell XPS 13', 'Dell XPS 13 laptop', 7, 'DL-XPS13', 38000.00, 32000.00, 8, 'pos-product-12.png'),
('LG Smart TV 55"', 'LG 55 inch Smart TV', 8, 'LG-TV55', 25000.00, 21000.00, 12, 'pos-product-05.png');

-- Insert sample customer
INSERT INTO customers (name, email, phone) VALUES 
('John Doe', 'john@example.com', '+1234567890'),
('Jane Smith', 'jane@example.com', '+0987654321'); 