<?php
include 'config.php';
require_role('peminjam');

$result = $mysqli->query("SELECT * FROM alat");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Katalog</title>
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
<h2>Katalog</h2>

<?php while ($row = $result->fetch_assoc()) { ?>
<div style="border:1px solid #ccc; margin:10px; padding:10px;">
    <h3><?= $row['namaalat'] ?></h3>
    <p>Stok: <?= $row['qty'] ?></p>

    <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="idalat" value="<?= $row['idalat'] ?>">
        <input type="number" name="qty" value="1" min="1" max="<?= $row['qty'] ?>">
        <button type="submit">Tambah ke Keranjang</button>
    </form>
</div>
<?php } ?>

</div>

</body>
</html>