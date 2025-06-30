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
    <?php $delay = 0; ?>
    <?php while ($row = $result->fetch_assoc()): ?>
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
      <?php $delay += 100; ?>
    <?php endwhile; ?>
  </div>
</main>

<!-- Modal -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <img src="" alt="" />
    <h3></h3>
    <p class="price"></p>
    <p class="description"></p>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });

  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#modal');
    const modalImg = modal.querySelector('img');
    const modalName = modal.querySelector('h3');
    const modalDesc = modal.querySelector('p.description');
    const modalPrice = modal.querySelector('p.price');
    const closeBtn = modal.querySelector('.close');

    document.querySelectorAll('.menu-item').forEach(item => {
      item.addEventListener('click', () => {
        modalImg.src = item.querySelector('img').src;
        modalName.textContent = item.querySelector('h3').textContent;
        modalPrice.textContent = item.querySelectorAll('p')[0].textContent;
        modalDesc.textContent = item.querySelectorAll('p')[1].textContent;
        modal.classList.add('show');
      });
    });

    closeBtn.addEventListener('click', () => {
      modal.classList.remove('show');
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('show');
      }
    });
  });
</script>

</body>
</html>
