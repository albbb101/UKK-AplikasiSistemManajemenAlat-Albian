<?php
include 'config.php';
require_role('peminjam');

// join kategori biar bisa tampil
$result = $mysqli->query("
SELECT alat.*, kategori.namakategori 
FROM alat 
LEFT JOIN kategori ON alat.idkategori = kategori.idkategori
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Katalog</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
<h2>Katalog</h2>

<?php while ($row = $result->fetch_assoc()) { ?>
<div style="border:1px solid #ccc; margin:10px; padding:15px; border-radius:10px;">

    <!-- ✅ GAMBAR -->
    <?php if ($row['gambaralat']) { ?>
        <img src="uploads/<?= $row['gambaralat'] ?>" width="120" style="display:block; margin-bottom:10px;">
    <?php } ?>

    <h3><?= $row['namaalat'] ?></h3>

    <!-- ✅ KATEGORI -->
    <p><b>Kategori:</b> <?= $row['namakategori'] ?? '-' ?></p>

    <!-- ✅ SPESIFIKASI -->
    <p><b>Spesifikasi:</b> <?= $row['spesifikasi'] ?></p>

    <p><b>Stok:</b> <?= $row['qty'] ?></p>

    <!-- ✅ PINJAM BUTTON -->
    <button onclick="toggleForm('form<?= $row['idalat'] ?>')">
        Pinjam
    </button>

    <!-- ✅ FORM (HIDDEN FIRST) -->
    <form id="form<?= $row['idalat'] ?>" 
      method="POST" 
      action="add_to_cart.php"
      style="display:none; margin-top:10px;">

    <input type="hidden" name="idalat" value="<?= $row['idalat'] ?>">

    Jumlah:
    <input type="number" name="qty" value="1" min="1" max="<?= $row['qty'] ?>">

    Lama Pinjam (hari):
    <input type="number" name="lama" value="1" min="1">

    <button type="submit">Tambah ke Keranjang</button>
</form>

</div>
<?php } ?>

</div>

<!-- ✅ SIMPLE JS -->
<script>
function toggleForm(id) {
    var form = document.getElementById(id);
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
</script>

</body>
</html> 