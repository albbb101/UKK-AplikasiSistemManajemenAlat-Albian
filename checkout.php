<?php
include 'config.php';

$iduser = $_SESSION['id'];
$cart = $_SESSION['cart'] ?? [];

foreach ($cart as $idalat => $qty) {

    $tglpinjam = date('Y-m-d');
    $tglkembali = date('Y-m-d');

    $mysqli->query("INSERT INTO peminjaman 
    (tglpinjam, tglkembali, idalat, qty, iduser, kondisiakhir, status)
    VALUES 
    ('$tglpinjam', '$tglkembali', '$idalat', '$qty', '$iduser', '-', 'menunggu')");
}

unset($_SESSION['cart']);

header("Location: peminjaman_user.php");
exit;