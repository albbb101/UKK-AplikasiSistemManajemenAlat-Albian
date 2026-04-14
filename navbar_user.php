<?php
if (!isset($_SESSION)) session_start();
?>

<div style="background:#6a1b9a; padding:15px; color:white; display:flex; justify-content:space-between;">

<div>
    <b>Aplikasi Peminjaman Alat</b>
</div>

<div style="display:flex; gap:20px;">
    <a href="peminjam_dashboard.php" style="color:white;">Dashboard</a>
    <a href="katalog.php" style="color:white;">Katalog</a>
    <a href="keranjang.php" style="color:white;">
        Keranjang (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)
    </a>
    <a href="peminjaman_user.php" style="color:white;">Peminjaman Saya</a>
    <a href="pengembalian_user.php" style="color:white;">Pengembalian</a>
    <a href="logout.php" style="color:white;">Logout</a>
</div>

</div>