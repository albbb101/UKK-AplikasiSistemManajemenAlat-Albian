<?php
include 'config.php';

$idalat = $_POST['idalat'];
$qty = $_POST['qty'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$idalat])) {
    $_SESSION['cart'][$idalat] += $qty;
} else {
    $_SESSION['cart'][$idalat] = $qty;
}

header("Location: katalog.php");
exit;