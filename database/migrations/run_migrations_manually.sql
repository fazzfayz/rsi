-- SQL untuk menambahkan kolom-kolom yang diperlukan
-- Jalankan query ini di phpMyAdmin atau MySQL client

-- 1. Tambahkan contact_person ke tabel clients
ALTER TABLE `clients` 
ADD COLUMN `contact_person` VARCHAR(255) NULL AFTER `name`;

-- 2. Tambahkan po_number ke tabel delivery_order_items
ALTER TABLE `delivery_order_items` 
ADD COLUMN `po_number` VARCHAR(255) NULL AFTER `name`;

-- 3. Tambahkan kolom-kolom employee ke tabel delivery_orders
ALTER TABLE `delivery_orders` 
ADD COLUMN `carrier_employee_id` BIGINT UNSIGNED NULL AFTER `driver_name`,
ADD COLUMN `signer_employee_id` BIGINT UNSIGNED NULL AFTER `carrier_employee_id`,
ADD COLUMN `receiver_name` VARCHAR(255) NULL AFTER `signer_employee_id`;

-- 4. Tambahkan foreign key constraints
ALTER TABLE `delivery_orders`
ADD CONSTRAINT `delivery_orders_carrier_employee_id_foreign` 
FOREIGN KEY (`carrier_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

ALTER TABLE `delivery_orders`
ADD CONSTRAINT `delivery_orders_signer_employee_id_foreign` 
FOREIGN KEY (`signer_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;
