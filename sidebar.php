<div class="sidebar">

    <div>
        <h2>Admin</h2>

        <a href="admin_dashboard.php" class="<?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">Dashboard</a>

        <a href="users.php" class="<?= ($activePage ?? '') == 'users' ? 'active' : '' ?>">Kelola User</a>

        <a href="kategori.php" class="<?= ($activePage ?? '') == 'kategori' ? 'active' : '' ?>">Kelola Kategori</a>

        <a href="alat.php" class="<?= ($activePage ?? '') == 'alat' ? 'active' : '' ?>">Kelola Alat</a>

        <a href="alat_masuk.php" class="<?= ($activePage ?? '') == 'alatmasuk' ? 'active' : '' ?>">Alat Masuk</a>

        <a href="peminjaman.php" class="<?= ($activePage ?? '') == 'peminjaman' ? 'active' : '' ?>">Peminjaman</a>

        <a href="log_aktivitas.php" class="<?= ($activePage ?? '') == 'log' ? 'active' : '' ?>">Log Aktivitas</a>

    </div>

    <div>
        <a href="logout.php">Logout</a>
    </div>

</div>