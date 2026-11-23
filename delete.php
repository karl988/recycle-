<?php include 'config.php';
$stmt = $conn->prepare("UPDATE rb_work_orders SET deleted_at = NOW(), deleted_by = ? WHERE id = ?");
$stmt->bind_param("si", $_SESSION['username'], $_GET['id']);
$stmt->execute();
header("Location: index.php");
