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
  <link rel="stylesheet" href="./style/menu.css" />

</head>
<body>

<main class="container">
  <h2>Today's Menu</h2>
  <form method="GET">
    <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
    <a href="menu.php"><button type="button">Clear</button></a>
  </form>

  <div class="menu-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="menu-item">
        <?php if (!empty($row['image'])): ?>
          <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <?php else: ?>
          <img src="default.jpg" alt="No image">
        <?php endif; ?>
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p>£<?= number_format($row['price'], 2) ?></p>
        <p><?= htmlspecialchars($row['description']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</main>

</body>
</html>
