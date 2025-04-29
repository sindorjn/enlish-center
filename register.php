<?php include 'header.php'; ?>
<h2>Ro'yxatdan o'tish</h2>

<?php
include 'db.php';                     // MySQL ulanish

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Foydalanuvchi kiritgan ma'lumotlar
    $name   = trim($_POST['name']   ?? '');
    $course = trim($_POST['course'] ?? '');
    $phone  = trim($_POST['phone']  ?? '');

    if ($name && $course && $phone) {

        // SQL – Prepared Statement
        $stmt = $conn->prepare(
            "INSERT INTO registrations (full_name, course, phone) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $name, $course, $phone);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">'
               . 'Hurmatli <strong>' . htmlspecialchars($name) . '</strong>, '
               . 'arizangiz qabul qilindi! Tez orada menejerimiz siz bilan bog‘lanadi.'
               . '</div>';
        } else {
            echo '<div class="alert alert-danger">Xatolik: ma\'lumotni saqlab bo‘lmadi.</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="alert alert-danger">Iltimos, barcha maydonlarni to‘ldiring.</div>';
    }
}
?>

<p>Quyidagi formani to'ldiring — ma'lumotlaringiz bazaga yoziladi:</p>

<form action="register.php" method="post">
  <div class="form-group">
    <label for="name">Ism familiyangiz:</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="course">Kursni tanlang:</label>
    <select name="course" id="course" class="form-control" required>
      <option value="">-- Tanlang --</option>
      <option value="Beginner">Beginner (Boshlang'ich)</option>
      <option value="Elementary">Elementary</option>
      <option value="Intermediate">Intermediate</option>
      <option value="Upper-Intermediate">Upper-Intermediate</option>
      <option value="Advanced">Advanced</option>
      <option value="IELTS">IELTS tayyorlov</option>
      <option value="General English">General English</option>
    </select>
  </div>

  <div class="form-group">
    <label for="phone">Telefon raqamingiz:</label>
    <input type="text" name="phone" id="phone" class="form-control" placeholder="+998" required>
  </div>

  <button type="submit" class="btn btn-primary">Yuborish</button>
</form>

<?php include 'footer.php'; ?>
