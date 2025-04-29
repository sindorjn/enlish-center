# Ingliz tili o‘quv markazi veb-sayti

Bu loyiha "Ingliz tili o‘quv markazi" uchun mo‘ljallangan zamonaviy veb-sayt bo‘lib, HTML, CSS, PHP va MySQL texnologiyalari yordamida ishlab chiqilgan.

## Asosiy imkoniyatlar

- Kurslar ro'yxatini ko‘rsatish
- Fikr-mulohazalar (testimonials) sahifasi
- Admin panel orqali ma'lumotlarni boshqarish
- Kurs jadvali va bog‘lanish formasi
- Ma'lumotlar bazasi bilan integratsiya (MySQL)

## Texnologiyalar

- **Frontend:** HTML5, CSS3
- **Backend:** PHP 8.x
- **Ma'lumotlar bazasi:** MySQL
- **Server:** Apache (XAMPP, OpenServer yoki boshqa lokal serverlar)

## Loyihani ishga tushirish

1. Loyihani GitHub’dan yuklab oling yoki `git clone` orqali nusxa oling:


2. Loyihani lokal serverda (XAMPP, OpenServer) `htdocs` yoki `www` papkaga joylashtiring.

3. MySQL serverni ishga tushiring va quyidagilarni bajaring:
- `english_center.sql` faylidan ma'lumotlar bazasini import qiling.

4. `config.php` faylida ma'lumotlar bazasi ulanishini sozlang:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "english_center";
