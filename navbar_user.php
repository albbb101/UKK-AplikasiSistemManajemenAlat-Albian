<?php if (!isset($_SESSION)) session_start(); ?>
<nav class="navbar">
    <div style="font-weight: bold; font-size: 20px;">Aplikasi Peminjaman Alat</div>
    <div class="user-nav-links" style="display: flex; gap: 10px; align-items: center;">
        
        <a href="peminjam_dashboard.php" 
           class="<?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        
        <a href="katalog.php" 
           class="<?= ($activePage ?? '') == 'katalog' ? 'active' : '' ?>">Katalog</a>
        
        <a href="keranjang.php" 
           class="<?= ($activePage ?? '') == 'keranjang' ? 'active' : '' ?>">
           Keranjang (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)
        </a>
        
        <a href="peminjaman_user.php" 
           class="<?= ($activePage ?? '') == 'pinjaman' ? 'active' : '' ?>">Pinjaman Saya</a>
        
        <a href="pengembalian_user.php" 
           class="<?= ($activePage ?? '') == 'riwayat' ? 'active' : '' ?>">Riwayat Pengembalian</a>
        
        <a href="logout.php" class="logout-link" onclick="return confirm('Logout?')">Logout</a>
    </div>
</nav>