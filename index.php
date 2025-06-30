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

  <!-- CSS -->
  <link rel="stylesheet" href="./style/index.css" />
  <link rel="stylesheet" href="./style/about-section.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <!-- logo -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<!-- HERO SECTION -->
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

<!-- MENU SECTION -->
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

<!-- FEEDBACK SECTION -->
<section class="feedback-swiper-section">
  <h2>💬 What Our Customers Say</h2>
  <div class="swiper">
    <div class="swiper-wrapper" style="height: 300px;">
      <?php
      $feedbackResult = $conn->query("SELECT name, message, image FROM feedback ORDER BY submitted_at DESC LIMIT 5");
      while ($fb = $feedbackResult->fetch_assoc()):
        $imageSrc = !empty($fb['image']) ? htmlspecialchars($fb['image']) : './img/default-user.png';
      ?>
        <div class="swiper-slide">
          <div class="feedback-slide">
            <img src="<?= $imageSrc ?>" alt="User photo" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin: 0 auto 10px;">
            <p class="feedback-text">“<?= htmlspecialchars($fb['message']) ?>”</p>
            <p class="feedback-author">– <?= htmlspecialchars($fb['name']) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<!-- ABOUT SECTION WITH BACKGROUND VIDEO -->
<section class="about-wrapper">
  <div class="background-video">
    <video autoplay muted loop playsinline>
      <source src="./img/video2.mp4" type="video/mp4">
    </video>
  </div>

  <section class="about-section">
    <div class="container">
      <h2>About Sweet Treats</h2>
      <div class="about-content">
        <div class="about-text" data-aos="fade-right">
   <p>At Sweet Treats, we believe that every dessert tells a story. From buttery croissants to rich chocolate cakes, our baked goods are crafted daily with care, tradition, and a sprinkle of magic.</p>
<p>Join us in savoring the sweet side of life. Whether you're treating yourself or sharing with loved ones, there's always a reason to celebrate with Sweet Treats!</p>

          <div class="social-links">
         <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
<a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
<a href="#"><i class="fab fa-twitter"></i> Twitter</a>

          </div>
        </div>

        <div class="about-video" data-aos="fade-left">
          <video autoplay muted loop playsinline>
            <source src="./img/about-video1.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </section>
</section>


</div>

<!-- FOOTER -->
<footer>
  <p>&copy; 2025 Sweet Treats Bakery</p>
</footer>
<div class="product-list">
 <?php
$result = $conn->query("SELECT name, description, price, image FROM menu_items ORDER BY date_added DESC LIMIT 9");
while ($row = $result->fetch_assoc()):
?>
  <div class="product-card" data-aos="fade-up" onclick="openModal(`<?= addslashes($row['name']) ?>`, `<?= addslashes($row['description']) ?>`, `<?= addslashes($row['image']) ?>`)">
    <h3><?= htmlspecialchars($row['name']) ?> – £<?= number_format($row['price'], 2) ?></h3>
    <p><?= htmlspecialchars($row['description']) ?></p>
    <?php if (!empty($row['image'])): ?>
      <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
    <?php endif; ?>
  </div>
<?php endwhile; ?>

</div>

<!-- JS Libraries -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
</script>

<script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".swiper", {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    speed: 800,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>

</body>
</html>
