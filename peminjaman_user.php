<?php
include 'config.php';
require_role('peminjam');

$iduser = $_SESSION['id'];

$result = $mysqli->query("
    SELECT 
        p.*, 
        p.qty AS qty_pinjam,
        a.namaalat, 
        a.spesifikasi, 
        a.qty AS stok, 
        a.gambaralat,
        k.namakategori
    FROM peminjaman p
    JOIN alat a ON p.idalat = a.idalat
    LEFT JOIN kategori k ON a.idkategori = k.idkategori
    WHERE p.iduser='$iduser'
    ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman Saya</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
    <h2>Peminjaman Saya</h2>

    <?php while ($row = $result->fetch_assoc()) : ?>
    <div style="border:1px solid #ccc; margin:10px 0; padding:15px; border-radius:10px; background:#fff;">
        <?php if (!empty($row['gambaralat'])) : ?>
            <img src="uploads/<?= $row['gambaralat'] ?>" width="120" style="display:block; margin-bottom:10px; border-radius:5px;">
        <?php endif; ?>

        <h3><?= htmlspecialchars($row['namaalat']) ?></h3>
        <p><b>Kategori:</b> <?= htmlspecialchars($row['namakategori'] ?? '-') ?></p>
        <p><b>Spesifikasi:</b> <?= htmlspecialchars($row['spesifikasi']) ?></p>
        <p><b>Jumlah Dipinjam:</b> <?= $row['qty_pinjam'] ?></p>
        <p><b>Status:</b> <?= strtoupper($row['status']) ?></p>

        <?php if ($row['status'] == 'dipinjam') : ?>
            <a href="request_kembali.php?id=<?= $row['idpinjam'] ?>" style="display:inline-block; margin-top:10px; text-decoration:none; background:#eee; padding:5px 10px; border:1px solid #999; color:#000; border-radius:5px;">
                Kembalikan
            </a>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>

</body>
</html>