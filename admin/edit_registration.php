<?php
include 'header.php';
include '../db.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) { header("Location: registrations.php"); exit; }

// Ma'lumotni olish
$stmt = $conn->prepare("SELECT * FROM registrations WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) { echo "<div class='container mt-4 alert alert-danger'>Ma’lumot topilmadi.</div>"; include 'footer.php'; exit; }

// FORM SUBMIT
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name   = trim($_POST['name']);
    $course = trim($_POST['course']);
    $phone  = trim($_POST['phone']);

    if ($name && $course && $phone) {
        $u = $conn->prepare("UPDATE registrations SET full_name=?, course=?, phone=? WHERE id=?");
        $u->bind_param("sssi", $name, $course, $phone, $id);
        $u->execute();
        $u->close();
        header("Location: registrations.php?msg=updated");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Barcha maydonlarni to‘ldiring.</div>";
    }
}
?>

<div class="container mt-4">
<h3>Ma’lumotni tahrirlash (ID: <?= $id; ?>)</h3>
<form method="post">
  <div class="form-group">
    <label>Ism, familiya</label>
    <input type="text" name="name" value="<?= htmlspecialchars($data['full_name']); ?>" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Kurs</label>
    <input type="text" name="course" value="<?= htmlspecialchars($data['course']); ?>" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Telefon</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']); ?>" class="form-control" required>
  </div>
  <button class="btn btn-primary">Saqlash</button>
  <a href="registrations.php" class="btn btn-secondary">Bekor qilish</a>
</form>
</div>

<?php include '../footer.php'; ?>
