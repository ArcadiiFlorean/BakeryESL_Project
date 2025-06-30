<?php
include 'db.php';
include 'header.php';
include 'modalwindow.php';  // Include modal window structure
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
  <link rel="stylesheet" href="./style/modalwindow.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    // Fetch products including recipe_or_story
    $result = $conn->query("SELECT name, description, price, image, recipe_or_story FROM menu_items ORDER BY date_added DESC LIMIT 9");
    while ($row = $result->fetch_assoc()):
    ?>
      <div class="product-card" data-aos="fade-up" onclick="openModal(`<?= addslashes($row['name']) ?>`, `<?= addslashes($row['description']) ?>`, `<?= addslashes($row['image']) ?>`, `<?= addslashes($row['recipe_or_story']) ?>`)">
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
      <source src="./img/video2.1.mp4" type="video/mp4">
    </video>
  </div>

  <section class="about-section">
    <div class="container">
      <h2 data-aos="fade-right"> About Sweet Treats</h2>
      <div class="about-content">
        <div class="about-text" data-aos="fade-right">
     <p>At Sweet Treats, we believe that every dessert tells a story, a journey that begins with the finest ingredients and ends with a smile on your face. From the first bite to the last, our creations are designed to transport you into a world of flavor, where every mouthful is a celebration of craftsmanship and passion. Each dessert is made with love, care, and an unwavering commitment to quality. Our chefs are dedicated to turning simple ingredients into extraordinary experiences, whether it's a rich chocolate cake, a buttery pastry, or a refreshing fruit tart. We don't just bake sweets, we create memories, moments to be cherished and shared with friends and family.</p>

<p>Join us in savoring the sweet side of life! Let our desserts be a part of your daily routine or your special occasions, bringing warmth and joy to your day. Whether you’re indulging in a moment of self-care or celebrating with loved ones, Sweet Treats is here to add a touch of magic to every occasion. Treat yourself to the happiness that comes with a perfectly crafted dessert, because at Sweet Treats, every bite is more than just food – it's a little piece of joy.</p>

          <div class="social-links">
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
          </div>
        </div>
        <div class="about-video" data-aos="fade-left">
          <video autoplay muted loop playsinline>
            <source src="./img/video2.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </section>
</section>

<!-- FOOTER -->
<?php include 'footer.php'; ?>
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

<!-- Modal Script -->
<script>
// Opening modal when clicking on a product card
function openModal(title, description, image, recipeOrStory) {
  document.getElementById('modalTitle').textContent = title;
  document.getElementById('modalDescription').textContent = description;
  document.getElementById('modalImage').src = image;
  document.getElementById('modalRecipeOrStory').textContent = recipeOrStory; // Afișează rețeta sau povestea
  document.getElementById('productModal').style.display = 'block';
}


// Closing modal when clicking on the close button
function closeModal() {
  document.getElementById('productModal').style.display = 'none';
}

// Optional: Close modal when clicking outside of it
window.onclick = function(event) {
  const modal = document.getElementById('productModal');
  if (event.target === modal) {
    closeModal();
  }
}
</script>

<!-- Modal Window -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h3 id="modalTitle"></h3>
    <img id="modalImage" src="" alt="Product Image" style="max-width: 100%; margin-bottom: 15px;">
    <p id="modalDescription"></p>
    <p id="modalRecipeOrStory"></p>
  </div>
</div>

</body>
</html>
