<?php
include 'header.php';   // sessiya tekshiruvi va navbar
include '../db.php';    // MySQL ulanish

// Statistikalar
$students = $conn->query("SELECT COUNT(*) FROM registrations")->fetch_row()[0];
// Keyin kurslar, fikrlar uchun tablitsa bo‘lsa, xohlasangiz shu tarzda:
$courses  = $conn->query("SELECT COUNT(DISTINCT course) FROM registrations")->fetch_row()[0];
// Misol tariqasida testimonials.json
$testCount = file_exists('../data/testimonials.json')
             ? count(json_decode(file_get_contents('../data/testimonials.json'), true))
             : 0;
?>
<div class="container mt-4">
  <h3>Admin Dashboard</h3>
  <div class="row text-center">
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1><?= $students; ?></h1>
          <p>Ro‘yxatdan o‘tgan o‘quvchilar</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1><?= $courses; ?></h1>
          <p>Talab tushgan kurslar</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1><?= $testCount; ?></h1>
          <p>Fikrlar soni</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../footer.php'; ?>
