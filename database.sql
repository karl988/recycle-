CREATE DATABASE IF NOT EXISTS workorder_db;
USE workorder_db;

CREATE TABLE IF NOT EXISTS rb_technicians (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS rb_work_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  technician_id INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  image VARCHAR(255) NULL DEFAULT NULL,
  deleted_at DATETIME NULL DEFAULT NULL,
  deleted_by VARCHAR(100) NULL DEFAULT NULL,
  FOREIGN KEY (technician_id) REFERENCES rb_technicians(id)
);

INSERT INTO rb_technicians (name) VALUES ('Juan Dela Cruz'), ('Maria Santos');

-- If you ALREADY have a rb_work_orders table, run only this instead:
-- ALTER TABLE rb_work_orders
--   ADD COLUMN deleted_at DATETIME NULL DEFAULT NULL,
--   ADD COLUMN deleted_by VARCHAR(100) NULL DEFAULT NULL,
--   ADD COLUMN image VARCHAR(255) NULL DEFAULT NULL;
