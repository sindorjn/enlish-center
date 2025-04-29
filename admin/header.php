<?php
/* ------- ADMIN SESSION CHECK ------- */
/* 
   Agar avval admin login tizimini yaratgan bo‘lsangiz
   (login.php → $_SESSION['admin_logged']=true), shu yerda tekshirasiz.
   Hozircha misol uchun, agar sessiya Mavjud bo‘lmasa – login.php ga yuboramiz.
*/
session_start();
if (empty($_SESSION['admin_logged'])) {
    header('Location: login.php');   // admin/login.php
    exit;
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin panel – Ingliz Markazi</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body { font-family: sans-serif; }
    .navbar-brand img { max-height:34px; margin-right:8px; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="dashboard.php">
    <img src="../img/logo.png" alt="Logo">
    Admin panel
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#adminNav" aria-controls="adminNav"
          aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="adminNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link"
          href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link"
          href="registrations.php">Ro‘yxat (Students)</a></li>
      <li class="nav-item"><a class="nav-link"
          href="courses.php">Kurslar</a></li>
      <li class="nav-item"><a class="nav-link"
          href="teachers.php">O‘qituvchilar</a></li>
      <li class="nav-item"><a class="nav-link"
          href="schedule.php">Dars jadvali</a></li>
      <li class="nav-item"><a class="nav-link"
          href="testimonials.php">Fikrlar</a></li>
    </ul>
    <span class="navbar-text mr-3">
      <?= $_SESSION['admin_name'] ?? 'Admin'; ?>
    </span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Chiqish</a>
  </div>
</nav>

<div class="container mt-4">
