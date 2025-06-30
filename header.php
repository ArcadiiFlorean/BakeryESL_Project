<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<link rel="stylesheet" href="./style/header.css" />

<header>
  <div class="container">
    <h1>Sweet Treats</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Daily Menu</a>
      <a href="feedback.php">Feedback</a>

      <?php if (isset($_SESSION['admin_id'])): ?>
        <a href="add_item.php">Add Item</a>
        <a href="view_feedback.php">View Feedback</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
