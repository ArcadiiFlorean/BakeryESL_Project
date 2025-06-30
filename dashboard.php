<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="./style/header.css" />
  <link rel="stylesheet" href="./style/dashboard.css" />
</head>
<body>

<?php include 'header.php'; ?>

<main class="dashboard-container">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
  <p>Use the links below to manage the site:</p>
  <ul class="dashboard-links">
    <li><a href="add_item.php">➕ Add Daily Menu Item</a></li>
    <li><a href="view_feedback.php">🗒️ View Feedback</a></li>
    <li><a href="logout.php" onclick="return confirm('Are you sure you want to log out?')">🚪 Logout</a></li>
  </ul>
</main>

<footer>
  <p>&copy; 2025 Sweet Treats Bakery</p>
</footer>

</body>
</html>
