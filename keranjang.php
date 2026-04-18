<?php
include 'config.php';
require_role('peminjam');

// Define active page
$activePage = 'keranjang';

$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'navbar_user.php'; ?>
    <div class="main" style="padding: 40px;">
        <div class="content">
            <h2>Keranjang Peminjaman</h2>

            <?php if (empty($cart)) : ?>
                <div style="text-align: center; padding: 50px;">
                    <p style="color: #888;">Keranjang Anda kosong.</p>
                    <a href="katalog.php" class="btn add">Cari Alat</a>
                </div>
            <?php else : ?>
                <div class="table-wrapper">
                    <table>
                        <tr style="background: #f4f6f9;">
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Lama Pinjam</th>
                            <th>Estimasi Kembali</th>
                            <th>Aksi</th>
                        </tr>
                        <?php foreach ($cart as $idalat => $item) : 
                            $query = $mysqli->query("SELECT a.* FROM alat a WHERE a.idalat='$idalat'");
                            $alat = $query->fetch_assoc();
                            $qty = is_array($item) ? ($item['qty'] ?? 0) : $item;
                            $lama = is_array($item) ? ($item['lama'] ?? 1) : 1;
                            $tglkembali = date('d M Y', strtotime("+" . (int)$lama . " days"));
                        ?>
                        <tr>
                            <td><strong><?= $alat['namaalat'] ?></strong></td>
                            <td><?= $qty ?> unit</td>
                            <td><?= $lama ?> hari</td>
                            <td><?= $tglkembali ?></td>
                            <td>
                                <a href="remove_cart.php?id=<?= $idalat ?>" class="btn delete" style="padding: 4px 8px; font-size: 12px;">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <form method="POST" action="checkout.php" style="margin-top:30px; text-align: right;">
                    <button type="submit" class="btn add" style="padding: 15px 30px; font-size: 16px;">
                        Konfirmasi Peminjaman Sekarang
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>