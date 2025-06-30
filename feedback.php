<?php
include 'db.php';
include 'header.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, submitted_at) VALUES (?, ?, ?, NOW())");
  $stmt->bind_param("sss", $name, $email, $message);
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

      <form method="POST">
        <label>Your Name:
          <input type="text" name="name" required>
        </label>

        <label>Your Email:
          <input type="email" name="email" required>
        </label>

        <label>Your Feedback:
          <textarea name="message" rows="5" required></textarea>
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
