<?php
define('FPDF_FONTPATH', __DIR__.'/lib/font/');
require_once 'lib/fpdf.php';
include '../db.php';

/* === FUNKSIYA === */
function latinize($s){
    $rep = ['Ў'=>"O'",'ў'=>"o'",'Ғ'=>"G'",'ғ'=>"g'",
            'Қ'=>'Q','қ'=>'q','Ҳ'=>'H','ҳ'=>'h',
            '‘'=>"'",'’'=>"'",'ʼ'=>"'",'´'=>"'",'`'=>"\'",
            '“'=>'"','”'=>'"'];
    return iconv('UTF-8','windows-1252//TRANSLIT', strtr($s,$rep));
}

/* === PDF === */
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10, latinize("Ro‘yxatdan o‘tgan o‘quvchilar"),0,1,'C');
$pdf->Ln(3);

/* Jadval sarlavhasi */
$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(220,220,220);
$pdf->Cell(10,8,'#',1,0,'C',true);
$pdf->Cell(55,8,latinize('Ism'),1,0,'C',true);
$pdf->Cell(40,8,latinize('Kurs'),1,0,'C',true);
$pdf->Cell(35,8,latinize('Telefon'),1,0,'C',true);
$pdf->Cell(45,8,latinize('Sana'),1,1,'C',true);

/* Ma’lumotlar */
$pdf->SetFont('Arial','',10);
$res = $conn->query("SELECT * FROM registrations ORDER BY id DESC");
$fill=false; $i=1;
while($row=$res->fetch_assoc()){
    $pdf->SetFillColor($fill?245:255);
    $pdf->Cell(10,8,$i++,1,0,'C',$fill);
    $pdf->Cell(55,8,latinize($row['full_name']),1,0,'L',$fill);
    $pdf->Cell(40,8,latinize($row['course']),1,0,'L',$fill);
    $pdf->Cell(35,8,$row['phone'],1,0,'L',$fill);
    $pdf->Cell(45,8,$row['created_at'],1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Output('I','registrations.pdf');
exit;
