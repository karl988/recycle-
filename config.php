<?php
session_start();
mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli("localhost", "root", "", "recycle");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Auto-create the tables (safe to run every time; uses new table names so it won't clash with old ones)
$conn->query("CREATE TABLE IF NOT EXISTS rb_technicians (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
)");
$conn->query("CREATE TABLE IF NOT EXISTS rb_work_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  technician_id INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  image VARCHAR(255) NULL DEFAULT NULL,
  deleted_at DATETIME NULL DEFAULT NULL,
  deleted_by VARCHAR(100) NULL DEFAULT NULL,
  FOREIGN KEY (technician_id) REFERENCES rb_technicians(id)
)");
$count = $conn->query("SELECT COUNT(*) AS c FROM rb_technicians")->fetch_assoc()['c'];
if ($count == 0) {
  $conn->query("INSERT INTO rb_technicians (name) VALUES ('Juan Dela Cruz'), ('Maria Santos')");
}

// Replace this with your real login session username if you have one.
if (!isset($_SESSION['username'])) { $_SESSION['username'] = "admin"; }
