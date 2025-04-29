<?php
include 'header.php';         // admin navbar
include '../db.php';          // MySQL ulanish

// -------- Delete so'rovi --------
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM registrations WHERE id=$id");
    header("Location: registrations.php?msg=deleted");
    exit;
}
?>

<div class="container mt-4">
<h3>Ro‘yxatdan o‘tgan o‘quvchilar</h3>

<a href="export_registrations.php"   class="btn btn-sm btn-danger mb-2" target="_blank">PDF</a>
<a href="export_registrations_csv.php"   class="btn btn-sm btn-success mb-2">CSV</a>



<?php if (isset($_GET['msg']) && $_GET['msg']==='updated'): ?>
  <div class="alert alert-success">Ma’lumot yangilandi.</div>
<?php elseif (isset($_GET['msg']) && $_GET['msg']==='deleted'): ?>
  <div class="alert alert-success">Ma’lumot o‘chirildi.</div>
<?php endif; ?>

<table class="table table-bordered table-hover">
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>Ism, familiya</th>
      <th>Kurs</th>
      <th>Telefon</th>
      <th>Sana</th>
      <th>Amallar</th>
    </tr>
  </thead>
  <tbody>
<?php
$res = $conn->query("SELECT * FROM registrations ORDER BY id DESC");
while ($row = $res->fetch_assoc()):
?>
    <tr>
      <td><?= $row['id']; ?></td>
      <td><?= htmlspecialchars($row['full_name']); ?></td>
      <td><?= htmlspecialchars($row['course']); ?></td>
      <td><?= htmlspecialchars($row['phone']); ?></td>
      <td><?= $row['created_at']; ?></td>
      <td>
        <a href="edit_registration.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">Tahrirlash</a>
        <a href="registrations.php?delete=<?= $row['id']; ?>"
           onclick="return confirm('O‘chirishga ishonchingiz komilmi?')"
           class="btn btn-sm btn-danger">O‘chirish</a>
      </td>
    </tr>
<?php endwhile; ?>
  </tbody>
</table>
</div>

<?php include '../footer.php'; ?>
