<?php
include 'auth.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="./style/dashboardadmin.css" />
</head>
<body>

<?php include 'header.php'; ?>

<main class="dashboard-container">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
  <p>Use the links below to manage the site:</p>

  <ul class="dashboard-links">
    <li><a href="add_item.php">➕ Add Daily Menu Item</a></li>
    <li><a href="view_feedback.php">🗒️ View Feedback</a></li>
    <li><a href="logout.php" class="logout-link">🚪 Logout</a></li>
  </ul>

  <h3 class="section-title">🧁 Current Menu Items</h3>

  <div class="admin-table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price (£)</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $conn->query("SELECT id, name, description, price, image FROM menu_items ORDER BY date_added DESC");

        if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
        ?>
        <tr>
          <td>
            <?php if (!empty($row['image']) && file_exists($row['image'])): ?>
              <img src="<?= htmlspecialchars($row['image']) ?>" alt="Image">
            <?php else: ?>
              <span class="no-image">N/A</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td>£<?= number_format($row['price'], 2) ?></td>
          <td>
            <a href="edit_item.php?id=<?= $row['id'] ?>" class="edit-btn">✏️ Edit</a>
            <a href="delete_item.php?id=<?= $row['id'] ?>" class="delete-btn">🗑️ Delete</a>
          </td>
        </tr>
        <?php
          endwhile;
        else:
        ?>
        <tr>
          <td colspan="5" class="no-items">No items found.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>
