<?php
session_start();

// Agar allaqachon kirgan bo‘lsa – dashboardga o‘tkazamiz
if (!empty($_SESSION['admin_logged'])) {
    header('Location: dashboard.php');   // yoki registrations.php
    exit;
}

// Forma yuborildimi?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // === Oddiy tekshiruv (demo) ===
    $VALID_USER = 'admin';
    $VALID_PASS = 'admin123';      // xohlagan parol

    if ($user === $VALID_USER && $pass === $VALID_PASS) {
        // Sessiya o‘zgaruvchilar
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_name']   = $VALID_USER;
        header('Location: dashboard.php');   // Muvaffaqiyatli kirish
        exit;
    } else {
        $error = 'Login yoki parol noto‘g‘ri.';
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin – Kirish</title>
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body{display:flex;align-items:center;justify-content:center;height:100vh;background:#f8f9fa;}
    .card{width:350px;}
  </style>
</head>
<body>
<div class="card shadow">
  <div class="card-body">
    <h4 class="card-title text-center mb-3">Admin panel – Kirish</h4>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label>Login</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Parol</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary btn-block">Kirish</button>
    </form>
  </div>
</div>
</body>
</html>
