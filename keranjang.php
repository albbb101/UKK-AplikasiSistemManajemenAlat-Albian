<?php
include 'config.php';
require_role('peminjam');

$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
<h2>Keranjang</h2>

<?php foreach ($cart as $idalat => $qty) {
    $alat = $mysqli->query("SELECT * FROM alat WHERE idalat='$idalat'")->fetch_assoc();
?>

<div style="border:1px solid #ccc; margin:10px; padding:10px;">
    <h3><?= $alat['namaalat'] ?></h3>
    <p>Jumlah: <?= $qty ?></p>

    <a href="remove_cart.php?id=<?= $idalat ?>">Hapus</a>
</div>

<?php } ?>

<form method="POST" action="checkout.php">
    <button type="submit">Konfirmasi Peminjaman</button>
</form>

</div>

</body>
</html>