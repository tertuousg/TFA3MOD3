CREATE DATABASE IF NOT EXISTS pos_accounts CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pos_accounts;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(30) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(120) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'Staff',
    avatar VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers (full_name, email, phone) VALUES
('Juan Dela Cruz', 'juan@example.com', '09171234567'),
('Maria Santos', 'maria@example.com', '09181234567'),
('Carlo Reyes', 'carlo@example.com', '09191234567');

INSERT INTO users (username, full_name, role, avatar) VALUES
('admin', 'System Administrator', 'Administrator', NULL),
('jdelacruz', 'Juan Dela Cruz', 'Cashier', NULL),
('msantos', 'Maria Santos', 'Cashier', NULL);
