<?php
include 'config.php';
require_role('peminjam');

$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
    <h2>Keranjang</h2>

    <?php if (empty($cart)) : ?>
        <p>Keranjang kosong.</p>
    <?php else : ?>
        <?php foreach ($cart as $idalat => $item) :
            $safe_id = $mysqli->real_escape_string($idalat);
            $query = $mysqli->query("
                SELECT a.*, k.namakategori 
                FROM alat a
                LEFT JOIN kategori k ON a.idkategori = k.idkategori
                WHERE a.idalat='$safe_id'
            ");
            $alat = $query->fetch_assoc();

            if (is_array($item)) {
                $qty = $item['qty'] ?? 0;
                $lama = $item['lama'] ?? 1;
            } else {
                $qty = $item;
                $lama = 1;
            }
        ?>
        <div style="border:1px solid #ccc; margin:10px 0; padding:15px; border-radius:10px; background:#fff;">
            <?php if (!empty($alat['gambaralat'])) : ?>
                <img src="uploads/<?= $alat['gambaralat'] ?>" width="120" style="display:block; margin-bottom:10px; border-radius:5px;">
            <?php endif; ?>

            <h3><?= htmlspecialchars($alat['namaalat'] ?? 'Alat Tidak Ditemukan') ?></h3>
            <p><b>Kategori:</b> <?= htmlspecialchars($alat['namakategori'] ?? '-') ?></p>
            <p><b>Spesifikasi:</b> <?= htmlspecialchars($alat['spesifikasi'] ?? '-') ?></p>
            <p><b>Stok:</b> <?= $alat['qty'] ?? 0 ?></p>
            <p><b>Jumlah:</b> <?= $qty ?></p>
            <p><b>Lama Pinjam:</b> <?= $lama ?> hari</p>

            <?php
            $tglkembali = date('Y-m-d', strtotime("+" . (int)$lama . " days"));
            ?>
            <p><b>Estimasi Kembali:</b> <?= $tglkembali ?></p>

            <a href="remove_cart.php?id=<?= urlencode($idalat) ?>" style="color:red; text-decoration:none;">Hapus</a>
        </div>
        <?php endforeach; ?>

        <form method="POST" action="checkout.php" style="margin-top:20px;">
            <button type="submit" style="padding:10px 20px; cursor:pointer;">Konfirmasi Peminjaman</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>