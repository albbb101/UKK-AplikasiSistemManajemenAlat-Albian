<?php
include 'config.php';
require_role('peminjam');
$iduser = $_SESSION['id'];

// Define active page
$activePage = 'dashboard';

$katalog = $mysqli->query("SELECT COUNT(*) as total FROM alat")->fetch_assoc()['total'];
$keranjang = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$aktif = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman WHERE iduser='$iduser' AND status IN ('menunggu','disetujui','dipinjam')")->fetch_assoc()['total'];

$recent = $mysqli->query("SELECT p.*, a.namaalat FROM peminjaman p JOIN alat a ON p.idalat = a.idalat WHERE p.iduser='$iduser' ORDER BY p.idpinjam DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="landing-body"> 
    <?php include 'navbar_user.php'; ?>
    <div class="main" style="padding: 40px;">
        <div class="content">
            <h2 style="margin-bottom: 5px;">Dashboard</h2>
            <p style="margin-bottom: 30px; color: #666;">Selamat datang, <strong><?= $_SESSION['name'] ?></strong>!</p>

            <div class="dashboard-cards">
                <div class="card">
                    <h4 style="margin-top:0;">Katalog Alat</h4>
                    <h2 style="color: #2f3e9e;"><?= $katalog ?></h2>
                    <a href="katalog.php" class="back-btn">Lihat Katalog →</a>
                </div>
                <div class="card">
                    <h4 style="margin-top:0;">Keranjang</h4>
                    <h2 style="color: orange;"><?= $keranjang ?></h2>
                    <a href="keranjang.php" class="back-btn">Cek Keranjang →</a>
                </div>
                <div class="card">
                    <h4 style="margin-top:0;">Pinjaman Aktif</h4>
                    <h2 style="color: #1f2a6d;"><?= $aktif ?></h2>
                    <a href="peminjaman_user.php" class="back-btn">Lihat Status →</a>
                </div>
            </div>

            <h3 style="margin-top: 40px; color: #1f2a6d;">Peminjaman Terbaru</h3>
            <div class="table-wrapper">
                <table>
                    <tr style="background: #f4f6f9;">
                        <th>Alat</th>
                        <th>Qty</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($row = $recent->fetch_assoc()) { ?>
                    <tr>
                        <td><strong><?= $row['namaalat'] ?></strong></td>
                        <td><?= $row['qty'] ?></td>
                        <td><span style="color: #2f3e9e; font-weight: bold;"><?= strtoupper($row['status']) ?></span></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>