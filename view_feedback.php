<?php
include 'db.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Customer Feedback</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./style/view_feedback.css">
</head>
<body>

  <main>
    <h2>Customer Feedback</h2>

    <?php
    $result = $conn->query("SELECT name, message, submitted_at FROM feedback ORDER BY submitted_at DESC");

    if ($result->num_rows > 0): ?>
      <ul>
      <?php while ($row = $result->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($row['name']) ?></strong>
          <br>
          <small>(<?= date("d M Y H:i", strtotime($row['submitted_at'])) ?>)</small>
          <br><br>
          <?= nl2br(htmlspecialchars($row['message'])) ?>
        </li>
      <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No feedback has been submitted yet.</p>
    <?php endif;

    $conn->close();
    ?>
  </main>

  <footer>
    <p style="text-align: center; margin-top: 40px;">&copy; 2025 Sweet Treats Bakery</p>
  </footer>

</body>
</html>
