<?php
require_once 'lib/fpdf.php';     // FPDF kutubxonasi

// header.php NI CHAQIRMAYMIZ !!!

// Fikrlar fayli
$testimonialsFile = '../data/testimonials.json';
$testimonials = [];

if (file_exists($testimonialsFile)) {
    $json = file_get_contents($testimonialsFile);
    $testimonials = json_decode($json, true);
}

// PDF yaratamiz
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetTitle('Foydalanuvchi fikrlari');

// Sarlavha
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Foydalanuvchi fikrlari (Testimonials)', 0, 1, 'C');
$pdf->Ln(5);

// Jadval sarlavhalari
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(10, 8, '#', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Rasm', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Ism', 1, 0, 'C', true);
$pdf->Cell(80, 8, 'Fikr', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Vaqt', 1, 1, 'C', true);

// Jadval ma'lumotlari
$pdf->SetFont('Arial', '', 10);
$fill = false;
$i = 1;

foreach ($testimonials as $t) {
    $pdf->SetFillColor($fill ? 245 : 255);
    
    $pdf->Cell(10, 20, $i++, 1, 0, 'C', $fill);    // # tartib
     
    // Rasm
    $x = $pdf->GetX();  // hozirgi X pozitsiya
    $y = $pdf->GetY();  // hozirgi Y pozitsiya
    
    $photoPath = '../' . $t['photo'];  // Rasm yo'li
    if (file_exists($photoPath)) {
        $pdf->Cell(20, 20, '', 1, 0, 'C', $fill);  // Bo'sh katak rasm uchun
        $pdf->Image($photoPath, $x+2, $y+2, 16, 16); // Rasmni chizamiz (16x16 ichida)
    } else {
        $pdf->Cell(20, 20, 'No Img', 1, 0, 'C', $fill);
    }

    // Ism
    $pdf->Cell(40, 20, iconv('UTF-8', 'windows-1252//TRANSLIT', $t['name']), 1, 0, 'L', $fill);
    
    // Fikr
    $comment = mb_strimwidth($t['comment'], 0, 60, '...');
    $pdf->Cell(80, 20, iconv('UTF-8', 'windows-1252//TRANSLIT', $comment), 1, 0, 'L', $fill);
    
    // Vaqt
    $pdf->Cell(40, 20, $t['time'], 1, 1, 'C', $fill);
    
    $fill = !$fill;
}

$pdf->Output('I', 'testimonials.pdf');
exit;
