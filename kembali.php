<?php
include 'config.php';

$id = $_GET['id'];

// tanggal hari ini
$today = date('Y-m-d');

$mysqli->query("
UPDATE peminjaman 
SET status='dikembalikan',
    tglkembali='$today'
WHERE idpinjam='$id'
");

header("Location: petugas_pengembalian.php");
exit;