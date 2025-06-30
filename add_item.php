<?php
include 'auth.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Upload imagine
  $imageName = null;
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . time() . '_' . $imageName;

    if (move_uploaded_file($imageTmp, $targetFile)) {
      $imageName = $targetFile; // salvăm calea relativă
    }
  }

  $stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, image, date_added) VALUES (?, ?, ?, ?, CURDATE())");
  $stmt->bind_param("ssds", $name, $description, $price, $imageName);
  $stmt->execute();
  $stmt->close();

  header("Location: menu.php");
  exit;
}
?>

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Item - BakeryESL</title>
<link rel="stylesheet" href="./style/add_item.css">
</head>
<body>
  <main class="container">
    <h2>Add New Menu Item</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>Item Name:<br>
        <input type="text" name="name" required>
      </label><br><br>

      <label>Description:<br>
        <textarea name="description" required></textarea>
      </label><br><br>

      <label>Price (£):<br>
        <input type="number" name="price" step="0.01" required>
      </label><br><br>

      <label>Upload Image:<br>
        <input type="file" name="image" accept="image/*">
      </label><br><br>

      <button type="submit">Add Item</button>
    </form>
  </main>
</body>
</html>
