<?php
include 'db.php';
include 'header.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $imagePath = null;

  // Procesare imagine dacă este încărcată
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $imageName = basename($_FILES['image']['name']);
    $imageName = time() . '_' . preg_replace("/[^A-Za-z0-9.\-_]/", "_", $imageName);
    $imagePath = $uploadDir . $imageName;

    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
  }

  // Salvare în baza de date
  $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, image, submitted_at) VALUES (?, ?, ?, ?, NOW())");
  $stmt->bind_param("ssss", $name, $email, $message, $imagePath);
  $stmt->execute();
  $stmt->close();

  $success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sweet Treats - Feedback</title>
  <link rel="stylesheet" href="./style/header.css">
  <link rel="stylesheet" href="./style/feedback.css">
</head>
<body>

<main>
  <div class="feedback-container">
    <h2>Leave Your Feedback</h2>

    <?php if ($success): ?>
      <p class="success-message">✅ Thank you! Your feedback has been received.</p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Your Name:
        <input type="text" name="name" required>
      </label>

      <label>Your Email:
        <input type="email" name="email" required>
      </label>

      <label>Your Feedback:
        <textarea name="message" rows="5" required></textarea>
      </label>

      <label>Upload Image (optional):
        <input type="file" name="image" accept="image/*">
      </label>

      <button type="submit">Submit Feedback</button>
    </form>
  </div>
</main>

<footer style="text-align: center; margin-top: 40px;">
  <p>&copy; 2025 Sweet Treats Bakery</p>
</footer>

</body>
</html>
