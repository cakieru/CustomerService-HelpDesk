-- 1. DUMMY EXTERNAL MODULE TABLE (E-commerce Management)
CREATE TABLE IF NOT EXISTS `customers` (
    `customer_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(50) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. DUMMY AGENTS TABLE (For ticket assignment mapping)
CREATE TABLE IF NOT EXISTS `support_agents` (
    `agent_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `role` VARCHAR(50) NOT NULL,
    `status` ENUM('Active', 'Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. MODULE OWNED TABLE: Support Tickets
CREATE TABLE IF NOT EXISTS `support_tickets` (
    `ticket_id` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` BIGINT NOT NULL,
    `assigned_agent_id` BIGINT NULL,
    `order_number` BIGINT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `category` ENUM('Product', 'Order', 'Payment', 'Return', 'Refund', 'Technical') NOT NULL,
    `priority` ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    `status` ENUM('Open', 'In Progress', 'Resolved', 'Closed') NOT NULL DEFAULT 'Open',
    `due_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`) ON DELETE CASCADE,
    FOREIGN KEY (`assigned_agent_id`) REFERENCES `support_agents`(`agent_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================
-- INSERTING DUMMY DATA MATCHING YOUR UI MOCKUP
-- ========================================================

-- Populate Customers from your E-commerce UI list
INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone`) VALUES
(1, 'Charlize', 'Casama', 'charlizecasama@email.com', '09123456789'),
(2, 'Gwen', 'Dogelio', 'gwendogelio@gmail.com', '09123456790'),
(3, 'Yuki', 'Watanabe', 'yukiwatanabe@email.com', '09123456791');

-- Populate Support Agents from your UI list
INSERT INTO `support_agents` (`agent_id`, `first_name`, `last_name`, `email`, `role`, `status`) VALUES
(1, 'Louise', 'Lane', 'louiselane@support.com', 'Support Agent', 'Active'),
(2, 'Prinz', 'Geon', 'prinzgeon@support.com', 'Support Agent', 'Active');

-- Populate Initial Tickets matching your UI screen
INSERT INTO `support_tickets` (`ticket_id`, `customer_id`, `assigned_agent_id`, `subject`, `description`, `category`, `priority`, `status`, `due_at`) VALUES
(1001, 1, 1, 'Order #54321 not received after 10 days', 'I placed an order 10 days ago and still havent received it. The tracking shows its stuck at the distribution center.', 'Order', 'High', 'Open', '2026-06-28 17:15:00'),
(1002, 2, 2, 'Received wrong item - ordered blue, got red', 'I ordered a blue variation but a red item was delivered instead.', 'Product', 'Medium', 'In Progress', NULL),
(1003, 3, NULL, 'Cannot apply discount code at checkout', 'Every time I try to input the summer discount code, it throws a systemic error.', 'Payment', 'Medium', 'Open', NULL);