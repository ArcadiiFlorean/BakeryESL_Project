<?php
include 'db.php';
include 'header.php';

$search = $_GET['search'] ?? '';
$query = "SELECT name, description, price, image FROM menu_items WHERE name LIKE ?";
$stmt = $conn->prepare($query);
$likeSearch = "%" . $search . "%";
$stmt->bind_param("s", $likeSearch);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daily Menu - BakeryESL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style/menu.css?v=2" />
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />





</head>
<body>

<main class="container">
  <h2>Today's Menu</h2>

  <form method="GET">
    <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
    <a href="menu.php" class="clear-button">Clear</a>
  </form>

 <div class="menu-grid">
  <?php
  $delay = 0;
  while ($row = $result->fetch_assoc()):
  ?>
    <div class="menu-item" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
      <?php if (!empty($row['image'])): ?>
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
      <?php else: ?>
        <img src="default.jpg" alt="No image">
      <?php endif; ?>
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p>£<?= number_format($row['price'], 2) ?></p>
      <p><?= htmlspecialchars($row['description']) ?></p>
    </div>
  <?php
    $delay += 100;
  endwhile;
  ?>
</div>

</main>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

</body>
</html>
