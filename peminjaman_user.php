<?php
include 'config.php';
require_role('peminjam');
$iduser = $_SESSION['id'];

// Define active page
$activePage = 'pinjaman';

$result = $mysqli->query("SELECT p.*, a.namaalat, a.gambaralat FROM peminjaman p JOIN alat a ON p.idalat = a.idalat WHERE p.iduser='$iduser' ORDER BY p.idpinjam DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman Saya</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'navbar_user.php'; ?>
    <div class="main" style="padding: 40px;">
        <div class="content">
            <h2>Riwayat & Status Peminjaman</h2>
            
            <div class="table-wrapper">
                <table>
                    <tr style="background: #f4f6f9;">
                        <th>Alat</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td style="display:flex; align-items:center; gap:10px;">
                            <?php if($row['gambaralat']){ ?>
                                <img src="uploads/<?= $row['gambaralat'] ?>" width="40" height="40" style="object-fit:cover; border-radius:4px;">
                            <?php } ?>
                            <strong><?= $row['namaalat'] ?></strong>
                        </td>
                        <td><?= $row['qty'] ?></td>
                        <td>
                            <span style="font-weight:bold; color: #2f3e9e;"><?= strtoupper($row['status']) ?></span>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'dipinjam') : ?>
                                <a href="request_kembali.php?id=<?= $row['idpinjam'] ?>" class="btn edit">
                                    Kembalikan
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>