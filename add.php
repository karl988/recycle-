<?php include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $imageName = null;
  if (!empty($_FILES['image']['name'])) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png','gif'])) {
      $imageName = uniqid() . "." . $ext;
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }
  }
  $stmt = $conn->prepare("INSERT INTO rb_work_orders (technician_id, description, image) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $_POST['technician_id'], $_POST['description'], $imageName);
  $stmt->execute();
  header("Location: index.php");
  exit;
}
$techs = $conn->query("SELECT * FROM rb_technicians");
?>
<!DOCTYPE html>
<html><head><title>Add Work Order</title></head><body style="font-family:Arial;margin:30px">
<h2>Add Work Order</h2>
<form method="POST" enctype="multipart/form-data">
  <p>Technician:
    <select name="technician_id">
      <?php while ($t = $techs->fetch_assoc()): ?>
        <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
      <?php endwhile; ?>
    </select></p>
  <p>Issue: <input type="text" name="description" required></p>
  <p>Image: <input type="file" name="image" accept="image/*" required></p>
  <button type="submit">Add</button> <a href="index.php">Cancel</a>
</form>
</body></html>
