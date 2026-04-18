<?php
include 'config.php';
require_role('petugas');
$activePage = 'dashboard';

// Fetching counts
$aktif = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman WHERE status='dipinjam'")->fetch_assoc()['total'];
$menunggu = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman WHERE status='menunggu'")->fetch_assoc()['total'];
$disetujui = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman WHERE status='disetujui'")->fetch_assoc()['total'];
$pengembalian = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman WHERE status='menunggu konfirmasi'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Aksi Cepat Styling - Matching Admin Dashboard */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .action-btn {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            display: block;
        }

        .action-btn:hover {
            border-color: #2f3e9e;
            background: #f0f2ff;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .action-btn h3 {
            margin: 0;
            font-size: 16px;
            color: #2f3e9e;
        }

        .action-btn p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body class="layout">

<?php include 'sidebar_petugas.php'; ?>

<div class="main">
    <div class="content">
        <h2 style="margin-bottom: 5px;">Dashboard Petugas</h2>
        <p style="margin-bottom: 30px; color: #666;">Selamat datang, <strong><?= $_SESSION['name'] ?></strong></p>
        
        <div class="dashboard-cards">
            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Peminjaman Aktif</h4>
                <h2 style="color: #2f3e9e; margin-bottom: 0;"><?= $aktif ?></h2>
            </div>
            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Menunggu Approval</h4>
                <h2 style="color: orange; margin-bottom: 0;"><?= $menunggu ?></h2>
            </div>
            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Siap Diambil</h4>
                <h2 style="color: #2f3e9e; margin-bottom: 0;"><?= $disetujui ?></h2>
            </div>
            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Menunggu Pengembalian</h4>
                <h2 style="color: #1f2a6d; margin-bottom: 0;"><?= $pengembalian ?></h2>
            </div>
        </div>

        <h3 style="margin-top: 40px; margin-bottom: 15px; color: #444;">Aksi Cepat</h3>
        <div class="quick-actions">
            <a href="petugas_peminjaman.php" class="action-btn">
                <h3>Kelola Peminjaman</h3>
                <p>Approval & pengambilan alat</p>
            </a>

            <a href="petugas_pengembalian.php" class="action-btn">
                <h3>Kelola Pengembalian</h3>
                <p>Cek kondisi & konfirmasi kembali</p>
            </a>

            <a href="petugas_laporan.php" class="action-btn">
                <h3>Lihat Laporan</h3>
                <p>Rekap data peminjaman</p>
            </a>
        </div>

    </div>
</div>

</body>
</html>