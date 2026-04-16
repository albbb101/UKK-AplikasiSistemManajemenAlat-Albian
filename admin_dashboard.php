<?php
include 'config.php';
require_role('admin');

/* ===== STATS ===== */

// Total users
$totalUsers = $mysqli->query("SELECT COUNT(*) as total FROM users")
->fetch_assoc()['total'];

// Total alat
$totalAlat = $mysqli->query("SELECT COUNT(*) as total FROM alat")
->fetch_assoc()['total'];

// Peminjaman menunggu
$peminjamanMenunggu = $mysqli->query("
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE status = 'menunggu'
")->fetch_assoc()['total'];

// Pengembalian menunggu konfirmasi
$pengembalianMenunggu = $mysqli->query("
    SELECT COUNT(*) as total 
    FROM peminjaman 
    WHERE status = 'menunggu konfirmasi'
")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php $activePage = 'dashboard'; ?>
<?php include 'sidebar.php'; ?>

<div class="main">

    <div class="dashboard-header">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang, <strong><?= $_SESSION['name']; ?></strong></p>
    </div>

    <!-- STATS -->
    <div class="dashboard-cards">

        <div class="card">
            <h3><?= $totalUsers ?></h3>
            <p>Total Users</p>
        </div>

        <div class="card">
            <h3><?= $totalAlat ?></h3>
            <p>Total Alat</p>
        </div>

        <div class="card">
            <h3><?= $peminjamanMenunggu ?></h3>
            <p>Peminjaman Menunggu</p>
        </div>

        <div class="card">
            <h3><?= $pengembalianMenunggu ?></h3>
            <p>Pengembalian Menunggu</p>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="section-title">
        <h3>Aksi Cepat</h3>
    </div>

    <div class="dashboard-cards">

        <a class="card action" href="users.php">
            <h3>Kelola User</h3>
        </a>

        <a class="card action" href="alat.php">
            <h3>Kelola Alat</h3>
        </a>

        <a class="card action" href="peminjaman.php">
            <h3>Kelola Peminjaman</h3>
        </a>

        <a class="card action" href="log_aktivitas.php">
            <h3>Lihat Log Aktivitas</h3>
        </a>

    </div>

</div>

</body>
</html>