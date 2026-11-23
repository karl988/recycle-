<?php include 'config.php';
$result = $conn->query("SELECT w.*, t.name AS technician FROM rb_work_orders w
  JOIN rb_technicians t ON w.technician_id = t.id
  WHERE w.deleted_at IS NOT NULL ORDER BY w.deleted_at DESC");
?>
<!DOCTYPE html>
<html><head><title>Recycle Bin</title>
<style>body{font-family:Arial;margin:30px}table{border-collapse:collapse}td,th{border:1px solid #999;padding:8px}</style>
</head><body>
<h2>Recycle Bin</h2>
<p><a href="index.php">&larr; Back to Work Orders</a></p>
<table>
<tr><th>ID</th><th>Technician</th><th>Issue</th><th>Image</th><th>Deleted By</th><th>Deleted At</th><th>Action</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['technician']) ?></td>
  <td><?= htmlspecialchars($row['description']) ?></td>
  <td><?php if ($row['image']): ?><img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="80"><?php endif; ?></td>
  <td><?= htmlspecialchars($row['deleted_by']) ?></td>
  <td><?= $row['deleted_at'] ?></td>
  <td><a href="restore.php?id=<?= $row['id'] ?>">Restore</a></td>
</tr>
<?php endwhile; ?>
</table>
</body></html>
