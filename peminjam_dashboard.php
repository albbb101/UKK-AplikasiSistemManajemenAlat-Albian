<?php
include 'config.php';
require_role('peminjam');

$iduser = $_SESSION['id'];

$katalog = $mysqli->query("SELECT COUNT(*) as total FROM alat")->fetch_assoc()['total'];
$keranjang = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$aktif = $mysqli->query("
SELECT COUNT(*) as total 
FROM peminjaman 
WHERE iduser='$iduser' 
AND status IN ('menunggu','disetujui','dipinjam')
")->fetch_assoc()['total'];

$recent = $mysqli->query("
SELECT p.*, a.namaalat 
FROM peminjaman p
JOIN alat a ON p.idalat = a.idalat
WHERE p.iduser='$iduser'
ORDER BY p.idpinjam DESC
LIMIT 3
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">

<h2>Dashboard</h2>
<h3>Selamat datang, <?= $_SESSION['name'] ?>!</h3>

<div style="display:flex; gap:20px; margin-top:20px;">

<div style="border:1px solid #ccc; padding:20px;">
    <h4>Katalog Alat</h4>
    <p><?= $katalog ?></p>
    <a href="katalog.php">Lihat</a>
</div>

<div style="border:1px solid #ccc; padding:20px;">
    <h4>Keranjang</h4>
    <p><?= $keranjang ?></p>
    <a href="keranjang.php">Lihat</a>
</div>

<div style="border:1px solid #ccc; padding:20px;">
    <h4>Peminjaman Aktif</h4>
    <p><?= $aktif ?></p>
    <a href="peminjaman_user.php">Lihat</a>
</div>

</div>

<br><br>

<h3>Peminjaman Terbaru</h3>

<?php while ($row = $recent->fetch_assoc()) { ?>
<div style="border:1px solid #ccc; margin:10px; padding:10px;">
    <b><?= $row['namaalat'] ?></b><br>
    Qty: <?= $row['qty'] ?><br>
    Status: <?= $row['status'] ?>
</div>
<?php } ?>

</div>

</body>
</html>