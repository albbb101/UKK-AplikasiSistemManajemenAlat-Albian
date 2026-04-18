<?php
include 'config.php';
require_role('peminjam');

// Define active page
$activePage = 'riwayat';

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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Saya</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div class="main" style="padding: 40px;">
    <div class="content">
        <h2 style="margin-bottom: 20px; color: #1f2a6d;">Riwayat Pengembalian</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr style="background: #f4f6f9;">
                        <th>Alat</th>
                        <th>Qty</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Kondisi Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td style="display:flex; align-items:center; gap:10px;">
                                <?php if($row['gambaralat']){ ?>
                                    <img src="uploads/<?= $row['gambaralat'] ?>" width="40" height="40" style="object-fit:cover; border-radius:4px;">
                                <?php } ?>
                                <strong><?= htmlspecialchars($row['namaalat']) ?></strong>
                            </td>
                            <td><?= $row['qty'] ?></td>
                            <td><?= $row['tglpinjam'] ?></td>
                            <td><?= $row['tglkembali'] ?? '-' ?></td>
                            <td>
                                <span style="font-weight:bold; color: <?= $row['status'] == 'dikembalikan' ? '#2e7d32' : 'orange' ?>;">
                                    <?= strtoupper($row['status']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['kondisiakhir'] ?: '-') ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 20px; color: #888;">
                                Belum ada data pengembalian.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="peminjam_dashboard.php" class="back-btn">← Kembali ke Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>