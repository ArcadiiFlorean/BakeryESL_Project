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
  <style>
    ul {
      max-width: 700px;
      margin: 30px auto;
      padding: 0 15px;
      list-style: none;
    }

    ul li {
      background: #fff;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      line-height: 1.5;
    }

    ul li strong {
      color: #cc3366;
    }

    .feedback-image {
      margin-top: 10px;
      max-width: 150px;
      border-radius: 6px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<main>
  <h2 style="text-align: center;">Customer Feedback</h2>

  <?php
  $result = $conn->query("SELECT name, message, image, submitted_at FROM feedback ORDER BY submitted_at DESC");

  if ($result->num_rows > 0): ?>
    <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <strong><?= htmlspecialchars($row['name']) ?></strong><br>
        <small>(<?= date("d M Y H:i", strtotime($row['submitted_at'])) ?>)</small><br><br>
        <?= nl2br(htmlspecialchars($row['message'])) ?>
        
        <?php if (!empty($row['image'])): ?>
          <div>
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="Feedback Image" class="feedback-image">
          </div>
        <?php endif; ?>
      </li>
    <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p style="text-align: center;">No feedback has been submitted yet.</p>
  <?php endif;

  $conn->close();
  ?>
</main>

<footer>
  <p style="text-align: center; margin-top: 40px;">&copy; 2025 Sweet Treats Bakery</p>
</footer>

</body>
</html>
