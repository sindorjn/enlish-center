<?php
// db.php  – MySQL ulanish (mysqli)
$host = 'localhost';
$user = 'root';
$pass = '';               // Open Server’da odatda bo‘sh
$db   = 'english_center_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('MySQL ulanish xatosi: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
