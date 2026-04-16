<?php
include 'config.php';
require_role('petugas');

// 📊 HITUNG DATA

// hanya yang benar-benar dipinjam
$aktif = $mysqli->query("
SELECT COUNT(*) as total 
FROM peminjaman 
WHERE status='dipinjam'
")->fetch_assoc()['total'];

// request baru
$menunggu = $mysqli->query("
SELECT COUNT(*) as total 
FROM peminjaman 
WHERE status='menunggu'
")->fetch_assoc()['total'];

// sudah disetujui tapi belum diambil
$disetujui = $mysqli->query("
SELECT COUNT(*) as total 
FROM peminjaman 
WHERE status='disetujui'
")->fetch_assoc()['total'];

// menunggu dikembalikan
$pengembalian = $mysqli->query("
SELECT COUNT(*) as total 
FROM peminjaman 
WHERE status='menunggu konfirmasi'
")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<body>

<?php include 'sidebar_petugas.php'; ?>

<div style="margin-left:220px; padding:20px;">
<h2>Dashboard Petugas</h2>

<p>Selamat datang, <?= $_SESSION['name'] ?></p>

<h3>Peminjaman Aktif: <?= $aktif ?></h3>
<h3>Menunggu Approval: <?= $menunggu ?></h3>
<h3>Siap Diambil: <?= $disetujui ?></h3>
<h3>Menunggu Pengembalian: <?= $pengembalian ?></h3>

</div>

</body>
</html>