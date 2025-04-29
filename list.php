<?php
include 'db.php';
$res = $conn->query("SELECT * FROM registrations ORDER BY id DESC");
echo "<pre>";
while ($row = $res->fetch_assoc()) print_r($row);
