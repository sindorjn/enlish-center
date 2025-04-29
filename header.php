<?php
// header.php – Har bir sahifaning yuqori qismi (boshi)
// Bu faylni barcha sahifalarga include qilamiz
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingliz Tili Markazi</title>
    <!-- Bootstrap CSS ulanishi -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; }
        .navbar-brand img { max-height: 40px; margin-right: 10px; }
        .footer { background: #f8f9fa; padding: 20px 0; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <img src="img/logo.png" alt="Logo"> Ingliz Markazi
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mainNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="index.php">Bosh sahifa</a></li>
      <li class="nav-item"><a class="nav-link" href="courses.php">Kurslar</a></li>
      <li class="nav-item"><a class="nav-link" href="teachers.php">O'qituvchilar</a></li>
      <li class="nav-item"><a class="nav-link" href="schedule.php">Dars jadvali</a></li>
      <li class="nav-item"><a class="nav-link" href="testimonials.php">Fikrlar</a></li>
      <li class="nav-item"><a class="nav-link" href="register.php">Ro'yxatdan o'tish</a></li>
      <li class="nav-item"><a class="nav-link" href="contact.php">Bog'lanish</a></li>
    </ul>
  </div>
</nav>
<div class="container mt-4">
