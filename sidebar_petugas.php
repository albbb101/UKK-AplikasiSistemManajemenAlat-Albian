<?php
if (!isset($_SESSION)) session_start();
?>
<div class="sidebar">
    <div>
        <h2>Petugas Panel</h2>
        <a href="petugas_dashboard.php" class="<?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        <a href="petugas_peminjaman.php" class="<?= ($activePage ?? '') == 'peminjaman' ? 'active' : '' ?>">Peminjaman</a>
        <a href="petugas_pengembalian.php" class="<?= ($activePage ?? '') == 'pengembalian' ? 'active' : '' ?>">Pengembalian</a>
        <a href="petugas_laporan.php" class="<?= ($activePage ?? '') == 'laporan' ? 'active' : '' ?>">Laporan</a>
    </div>

    <div>
        <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>
</div>