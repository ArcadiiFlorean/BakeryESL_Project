<?php
include 'db.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid ID.");
}

$id = intval($_GET['id']);

// Salvare modificări
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $price = floatval($_POST['price']);
  $newImagePath = $_POST['existing_image'];

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . time() . "_" . $imageName;

    if (move_uploaded_file($imageTmp, $targetFile)) {
      $newImagePath = $targetFile;
    }
  }

  $stmt = $conn->prepare("UPDATE menu_items SET name=?, price=?, image=? WHERE id=?");
  $stmt->bind_param("sdsi", $name, $price, $newImagePath, $id);
  $stmt->execute();
  $stmt->close();

  header("Location: dashboard.php");
  exit;
}

// Afișare date existente
$stmt = $conn->prepare("SELECT name, price, image FROM menu_items WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $price, $image);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/edit_item.css">
</head>
<body>

<main class="edit-container">
  <h2>Edit Product</h2>

  <form method="POST" enctype="multipart/form-data">
    <label>Name:
      <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    </label>

    <label>Price (£):
      <input type="number" step="0.01" name="price" value="<?= $price ?>" required>
    </label>

    <label>Current Image:
      <?php if (!empty($image) && file_exists($image)): ?>
        <img src="<?= htmlspecialchars($image) ?>" alt="Product Image">
      <?php else: ?>
        <span>No image uploaded</span>
      <?php endif; ?>
    </label>

    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($image) ?>">

    <label>New Image (optional):
      <input type="file" name="image" accept="image/*">
    </label>

    <button type="submit">Update</button>
  </form>

  <a href="dashboard.php">← Back to Dashboard</a>
</main>

</body>
</html>
