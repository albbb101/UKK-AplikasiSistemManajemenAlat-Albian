<?php
include 'config.php';
require_role('petugas');
$activePage = 'peminjaman';

$result = $mysqli->query("
    SELECT p.*, u.namalengkap AS peminjam, a.namaalat
    FROM peminjaman p
    JOIN users u ON p.iduser = u.id
    JOIN alat a ON p.idalat = a.idalat
    ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">

<?php include 'sidebar_petugas.php'; ?>

<div class="main">
    <div class="content">
        <h2>Data Peminjaman</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Qty</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['idpinjam'] ?></td>
                    <td><?= $row['peminjam'] ?></td>
                    <td><?= $row['namaalat'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['tglpinjam'] ?></td>
                    <td>
                        <span style="font-weight:bold; color: <?= $row['status'] == 'menunggu' ? 'orange' : '#1f2a6d' ?>;">
                            <?= strtoupper($row['status']) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['status'] == 'menunggu') { ?>
                            <a href="approve.php?id=<?= $row['idpinjam'] ?>" class="btn add">Approve</a>
                            <a href="reject.php?id=<?= $row['idpinjam'] ?>" class="btn delete">Reject</a>
                        <?php } elseif ($row['status'] == 'disetujui') { ?>
                            <a href="ambil.php?id=<?= $row['idpinjam'] ?>" class="btn edit">Ambil</a>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>