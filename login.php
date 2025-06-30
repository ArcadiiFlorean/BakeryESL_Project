<?php
session_start();
include 'db.php';
include 'header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $hashed);
    $stmt->fetch();

    if (password_verify($password, $hashed)) {
      $_SESSION['admin_id'] = $id;
      $_SESSION['username'] = $username;
      header('Location: dashboard.php');
      exit;
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "User not found.";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BakeryESL - Admin Login</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    .login-container {
      max-width: 400px;
      margin: 80px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #cc3366;
    }

    form label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      background-color: #cc3366;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 6px;
      margin-top: 15px;
      cursor: pointer;
    }

    button:hover {
      background-color: #aa2955;
    }

    .error {
      color: red;
      text-align: center;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Bakery Admin Login</h2>

    <?php if ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
      <label>Username:
        <input type="text" name="username" required>
      </label>

      <label>Password:
        <input type="password" name="password" required>
      </label>

      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
