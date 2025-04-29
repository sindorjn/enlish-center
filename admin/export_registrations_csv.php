<?php
include '../db.php';                // MySQL ulanish

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="registrations.csv"');

$out = fopen('php://output', 'w');

// UTF-8 BOM, Excel CSV ni to‘g‘ri o‘qishi uchun
fwrite($out, chr(0xEF).chr(0xBB).chr(0xBF));

// Sarlavha qatori
fputcsv($out, ['ID','Ism','Kurs','Telefon','Sana'], ';');

$res = $conn->query("SELECT * FROM registrations ORDER BY id DESC");
while ($r = $res->fetch_assoc()) {
    fputcsv($out, $r, ';');         // `;` – ajratuvchi
}
fclose($out);
exit;
