<?php
include 'config.php';
require_role('petugas');
$activePage = 'pengembalian';

$result = $mysqli->query("
    SELECT p.*, u.namalengkap AS peminjam, a.namaalat
    FROM peminjaman p
    JOIN users u ON p.iduser = u.id
    JOIN alat a ON p.idalat = a.idalat
    WHERE p.status='menunggu konfirmasi'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">

<?php include 'sidebar_petugas.php'; ?>

<div class="main">
    <div class="content">
        <h2>Konfirmasi Pengembalian</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Qty</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>

                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['idpinjam'] ?></td>
                    <td><?= $row['peminjam'] ?></td>
                    <td><?= $row['namaalat'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['kondisiakhir'] ? $row['kondisiakhir'] : '-' ?></td>
                    <td>
                        <a href="kembali.php?id=<?= $row['idpinjam'] ?>" 
                           class="btn add"
                           onclick="return confirm('Konfirmasi barang sudah dikembalikan?')">
                           Konfirmasi
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>