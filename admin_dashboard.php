<?php
include 'config.php';
require_role('admin');
$activePage = 'dashboard';

$total_users = $mysqli->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_kategori = $mysqli->query("SELECT COUNT(*) as total FROM kategori")->fetch_assoc()['total'];
$total_alat = $mysqli->query("SELECT COUNT(*) as total FROM alat")->fetch_assoc()['total'];
$total_pinjam = $mysqli->query("SELECT COUNT(*) as total FROM peminjaman")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Aksi Cepat Styling */
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

<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="content">
        <h2 style="margin-bottom: 5px;">Admin Dashboard</h2>
        <p style="margin-bottom: 30px; color: #666;">Selamat datang, <strong><?= $_SESSION['name'] ?></strong></p>
        
        <div class="dashboard-cards">
            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Total User</h4>
                <h2 style="color: #2f3e9e; margin-bottom: 0;"><?= $total_users ?></h2>
            </div>

            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Kategori Alat</h4>
                <h2 style="color: #2f3e9e; margin-bottom: 0;"><?= $total_kategori ?></h2>
            </div>

            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Total Alat</h4>
                <h2 style="color: #1f2a6d; margin-bottom: 0;"><?= $total_alat ?></h2>
            </div>

            <div class="card">
                <h4 style="margin-top: 0; color: #555;">Total Transaksi</h4>
                <h2 style="color: orange; margin-bottom: 0;"><?= $total_pinjam ?></h2>
            </div>
        </div>

        <h3 style="margin-top: 40px; margin-bottom: 15px; color: #444;">Aksi Cepat</h3>
        <div class="quick-actions">
            <a href="users.php" class="action-btn">
                <h3>Kelola User</h3>
                <p>Tambah atau edit pengguna</p>
            </a>

            <a href="alat.php" class="action-btn">
                <h3>Kelola Alat</h3>
                <p>Tambah data alat & stok</p>
            </a>

            <a href="peminjaman.php" class="action-btn">
                <h3>Kelola Peminjaman</h3>
                <p>Pantau pinjam & kembali</p>
            </a>

            <a href="log_aktivitas.php" class="action-btn">
                <h3>Lihat Log Aktivitas</h3>
                <p>Pantau riwayat login & logout</p>
            </a>
        </div>

    </div>
</div>

</body>
</html>