<?php include 'config.php';
$result = $conn->query("SELECT w.*, t.name AS technician FROM rb_work_orders w
  JOIN rb_technicians t ON w.technician_id = t.id
  WHERE w.deleted_at IS NULL ORDER BY w.id");
?>
<!DOCTYPE html>
<html><head><title>Work Orders</title>
<style>body{font-family:Arial;margin:30px}table{border-collapse:collapse}td,th{border:1px solid #999;padding:8px}</style>
</head><body>
<h2>Work Orders</h2>
<p><a href="add.php">+ Add Work Order</a> | <a href="recycle_bin.php">Recycle Bin</a></p>
<table>
<tr><th>ID</th><th>Technician</th><th>Issue</th><th>Image</th><th>Action</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['technician']) ?></td>
  <td><?= htmlspecialchars($row['description']) ?></td>
  <td><?php if ($row['image']): ?><img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="80"><?php endif; ?></td>
  <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>
</body></html>
