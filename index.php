<?php
include 'db.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sweet Treats - Home</title>
  <link rel="stylesheet" href="./style/index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

</head>
<body>

<section class="hero">
  <video autoplay muted loop playsinline>
    <source src="./img/herovideo.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
  <div class="hero-content">
    <h2>Welcome to Sweet Treats!</h2>
    <p>Discover our delicious daily menu and let us know what you think.</p>
  </div>
</section>

<main class="container">
  <h2>Today's Highlights</h2>
  <div class="product-list">
  <?php
  $result = $conn->query("SELECT name, description, price, image FROM menu_items ORDER BY date_added DESC LIMIT 9");
  while ($row = $result->fetch_assoc()):
  ?>
    <div class="product-card" data-aos="fade-up">
      <h3><?= htmlspecialchars($row['name']) ?> – £<?= number_format($row['price'], 2) ?></h3>
      <p><?= htmlspecialchars($row['description']) ?></p>
      <?php if (!empty($row['image'])): ?>
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
</div>


  <p style="margin-top: 20px; text-align: center;">
    <a href="menu.php">See full menu →</a>
  </p>
</main>

<footer>
  <p>&copy; 2025 Sweet Treats Bakery</p>
</footer>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // durată în milisecunde
    once: true      // animarea să nu se repete la fiecare scroll
  });
</script>

</body>
</html>
