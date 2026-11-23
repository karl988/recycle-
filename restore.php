<?php include 'config.php';
$stmt = $conn->prepare("UPDATE rb_work_orders SET deleted_at = NULL, deleted_by = NULL WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
header("Location: index.php");
