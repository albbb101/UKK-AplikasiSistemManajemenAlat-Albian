<?php
if (!isset($_SESSION)) session_start();
?>

<div style="width:200px; height:100vh; background:#2e7d32; color:white; float:left; padding:20px;">

<h3>Petugas Panel</h3>

<p><a href="petugas_dashboard.php" style="color:white;">Dashboard</a></p>
<p><a href="petugas_peminjaman.php" style="color:white;">Peminjaman</a></p>
<p><a href="petugas_pengembalian.php" style="color:white;">Pengembalian</a></p>
<p><a href="petugas_laporan.php" style="color:white;">Laporan</a></p>
<p><a href="logout.php" style="color:white;"
onclick="return confirm('Yakin ingin logout?')">Logout</a></p>

</div>