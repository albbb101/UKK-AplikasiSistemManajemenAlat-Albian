<?php
include 'config.php';

$idalat = $_POST['idalat'];
$qty = $_POST['qty'];
$lama = $_POST['lama'] ?? 1; // default 1 hari

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// store as array (NOT just qty anymore)
$_SESSION['cart'][$idalat] = [
    'qty' => $qty,
    'lama' => $lama
];

header("Location: katalog.php");
exit;