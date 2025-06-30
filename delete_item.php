<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

header("Location: menu.php");
exit;
