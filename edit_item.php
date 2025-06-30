<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Update after submit
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $description, $price, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: menu.php");
    exit;
  }

  // Fetch existing data
  $stmt = $conn->prepare("SELECT name, description, price FROM menu_items WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($name, $description, $price);
  $stmt->fetch();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu Item</title>
</head>
<body>
  <h2>Edit Menu Item</h2>
  <form method="POST">
    <label>Name:<br><input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required></label><br><br>
    <label>Description:<br><textarea name="description" required><?= htmlspecialchars($description) ?></textarea></label><br><br>
    <label>Price (£):<br><input type="number" step="0.01" name="price" value="<?= $price ?>" required></label><br><br>
    <button type="submit">Update</button>
  </form>
  <br>
  <a href="menu.php">← Back to Menu</a>
</body>
</html>
