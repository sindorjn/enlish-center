<?php include 'header.php'; ?>

<h2 class="text-center mb-4">O'quvchilar Fikrlari</h2>

<?php
// ---------  CONFIG  ----------
$dataFile   = __DIR__ . '/data/testimonials.json';
$maxPerPage = 50; // xavfsizlik uchun cheklash
$defaultImg = 'img/anonymous.png';
// -----------------------------

// 1)  Fikr yuborildi – uni saqlaymiz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $photo   = '';

    // oddiy validatsiya
    if ($name && $comment) {

        // Rasm yuklandi (ixtiyoriy)
        if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $safeName = 'user_' . time() . rand(100,999) . '.' . $ext;
            $uploadPath = __DIR__ . '/img/' . $safeName;
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath);
            $photo = 'img/' . $safeName;
        }

        // Fikr ma'lumoti
        $newItem = [
            'name'    => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'comment' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'),
            'photo'   => $photo ?: $defaultImg,
            'time'    => date('Y-m-d H:i')
        ];

        // Eski ro‘yxatni o‘qish
        $items = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
        $items[] = $newItem;

        // Faqat oxirgi $maxPerPage ta fikrni saqlash
        $items = array_slice($items, -$maxPerPage);

        // Faylga yozish
        if (!is_dir(dirname($dataFile))) {
            mkdir(dirname($dataFile), 0777, true);
        }
        file_put_contents($dataFile, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo '<div class="alert alert-success">Fikringiz uchun rahmat! U muvaffaqiyatli qo‘shildi.</div>';
    } else {
        echo '<div class="alert alert-danger">Iltimos, ism va fikr matnini to‘ldiring.</div>';
    }
}

// 2)  Mavjud fikrlarni chiqarish
$testimonials = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Orqadan – yangi fikr birinchi
$testimonials = array_reverse($testimonials);

// Demo ma'lumot bo‘lmasa, 2 ta oldindan yozilgan fikr
if (empty($testimonials)) {
    $testimonials = [
        [
            'name'    => 'Nilufar',
            'comment' => 'Bu markazda o‘qib IELTS 7.5 oldim! Tavsiya qilaman.',
            'photo'   => 'img/student1.jpg',
            'time'    => '2025-03-12 14:30'
        ],
        [
            'name'    => 'Akbar',
            'comment' => 'General English kursidan keyin ish joyimda erkin gapira boshladim.',
            'photo'   => 'img/student2.jpg',
            'time'    => '2025-02-28 10:45'
        ]
    ];
}
?>

<div class="row">
<?php foreach ($testimonials as $t): ?>
    <div class="col-md-6 mb-4">
        <div class="media shadow-sm p-3 bg-light rounded h-100">
            <img src="<?= $t['photo']; ?>" class="mr-3 rounded-circle" alt="Avatar" width="64" height="64">
            <div class="media-body">
                <h5 class="mt-0"><?= $t['name']; ?></h5>
                <small class="text-muted"><?= $t['time']; ?></small>
                <p class="mb-0"><?= $t['comment']; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<hr>
<h3 class="mt-4">Fikr qoldiring</h3>
<form action="testimonials.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Ismingiz:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="comment">Fikringiz:</label>
        <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="photo">Rasmingiz (ixtiyoriy, JPG/PNG):</label>
        <input type="file" name="photo" id="photo" accept="image/*" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Yuborish</button>
</form>

<?php include 'footer.php'; ?>
