<?php
include 'config.php';
require_role('peminjam');

$iduser = $_SESSION['id'];
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: keranjang.php");
    exit;
}

foreach ($cart as $idalat => $item) {

    $qty = $item['qty'];
    $lama = $item['lama'];

    $tglpinjam = date('Y-m-d');
    $tglkembali = date('Y-m-d', strtotime("+$lama days"));

    // insert peminjaman
    $mysqli->query("
        INSERT INTO peminjaman 
        (tglpinjam, tglkembali, idalat, qty, iduser, kondisiakhir, status)
        VALUES 
        ('$tglpinjam', '$tglkembali', '$idalat', '$qty', '$iduser', '', 'menunggu')
    ");
}

// kosongkan cart
unset($_SESSION['cart']);

header("Location: peminjaman_user.php");
exit;