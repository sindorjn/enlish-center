<?php
include 'header.php';    // Admin panel header (navbar)

$testimonialsFile = '../data/testimonials.json';
$testimonials = [];

if (file_exists($testimonialsFile)) {
    $json = file_get_contents($testimonialsFile);
    $testimonials = json_decode($json, true);
}

// --- DELETE tugmasidan kelgan so'rovni ishlash ---
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];

    if (isset($testimonials[$index])) {
        // Fikrni o'chirib tashlash
        array_splice($testimonials, $index, 1);
        // Yangilangan ma'lumotni JSON faylga yozish
        file_put_contents($testimonialsFile, json_encode($testimonials, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        header('Location: testimonials.php?deleted=1');
        exit;
    }
}
?>

<div class="container mt-4">
  <h3>Foydalanuvchi fikrlari (Testimonials)</h3>
  <a href="export_testimonials_pdf.php" class="btn btn-sm btn-success mb-3" target="_blank">
    PDF-ga eksport
</a>


  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Fikr muvaffaqiyatli o‘chirildi.</div>
  <?php endif; ?>

  <?php if (empty($testimonials)): ?>
    <div class="alert alert-warning">Hozircha hech qanday fikrlar mavjud emas.</div>
  <?php else: ?>

  <table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Rasm</th>
        <th>Ism</th>
        <th>Fikr</th>
        <th>Vaqt</th>
        <th>Amal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($testimonials as $i => $t): ?>
      <tr>
        <td><?= $i+1; ?></td>
        <td>
          <img src="../<?= htmlspecialchars($t['photo']); ?>" alt="User Photo" width="48" height="48" style="object-fit:cover; border-radius:50%;">
        </td>
        <td><?= htmlspecialchars($t['name']); ?></td>
        <td><?= htmlspecialchars($t['comment']); ?></td>
        <td><?= htmlspecialchars($t['time']); ?></td>
        <td>
          <a href="testimonials.php?delete=<?= $i; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?');">
            O‘chirish
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>

<?php include '../footer.php'; ?>
