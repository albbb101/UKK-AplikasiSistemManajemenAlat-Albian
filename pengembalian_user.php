<?php
include 'config.php';
require_role('peminjam');

$iduser = $_SESSION['id'];

$result = $mysqli->query("
    SELECT p.*, a.namaalat, a.spesifikasi, a.qty as stok_sekarang, a.gambaralat, k.namakategori
    FROM peminjaman p
    JOIN alat a ON p.idalat = a.idalat
    LEFT JOIN kategori k ON a.idkategori = k.idkategori
    WHERE p.iduser='$iduser'
    AND (p.status='menunggu konfirmasi' OR p.status='dikembalikan')
    ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian Saya</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
    <h2>Pengembalian Saya</h2>

    <?php if ($result->num_rows == 0) : ?>
        <p>Belum ada data pengembalian.</p>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()) : ?>
    <div style="border:1px solid #ccc; margin:10px 0; padding:15px; border-radius:10px; background:#fff;">
        <?php if (!empty($row['gambaralat'])) : ?>
            <img src="uploads/<?= $row['gambaralat'] ?>" width="120" style="display:block; margin-bottom:10px; border-radius:5px;">
        <?php endif; ?>

        <h3><?= htmlspecialchars($row['namaalat']) ?></h3>
        <p><b>Kategori:</b> <?= htmlspecialchars($row['namakategori'] ?? '-') ?></p>
        <p><b>Jumlah:</b> <?= $row['qty'] ?></p>
        <p><b>Tanggal Pinjam:</b> <?= $row['tglpinjam'] ?></p>
        <p><b>Tanggal Kembali:</b> <?= $row['tglkembali'] ?? '-' ?></p>
        <p><b>Status:</b> <b><?= strtoupper($row['status']) ?></b></p>
        <p><b>Kondisi:</b> <?= htmlspecialchars($row['kondisiakhir'] ?: '-') ?></p>
    </div>
    <?php endwhile; ?>
</div>

</body>
</html>