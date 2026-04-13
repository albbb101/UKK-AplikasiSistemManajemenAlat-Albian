<?php
include 'config.php';
require_role('admin');

$kategori = $mysqli->query("SELECT * FROM kategori");

if (isset($_POST['submit'])) {
    $id = $_POST['idalat'];
    $idkategori = $_POST['idkategori'];
    $nama = $_POST['namaalat'];
    $spesifikasi = $_POST['spesifikasi'];
    $qty = $_POST['qty'];

    $gambar = '';

    if (!empty($_FILES['gambaralat']['name'])) {
        $filename = $_FILES['gambaralat']['name'];
        move_uploaded_file($_FILES['gambaralat']['tmp_name'], "uploads/" . $filename);
        $gambar = $filename;
    }

    $mysqli->query("INSERT INTO alat 
    (idalat, idkategori, namaalat, spesifikasi, gambaralat, qty)
    VALUES ('$id','$idkategori','$nama','$spesifikasi','$gambar','$qty')");

    header("Location: alat.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Alat</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Tambah Alat</h2>

<div class="form-box">
<form method="POST" enctype="multipart/form-data">

ID Alat:
<input type="text" name="idalat" required>

Kategori:
<select name="idkategori">
<?php while ($k = $kategori->fetch_assoc()) { ?>
    <option value="<?= $k['idkategori'] ?>">
        <?= $k['namakategori'] ?>
    </option>
<?php } ?>
</select>

Nama Alat:
<input type="text" name="namaalat" required>

Spesifikasi:
<input type="text" name="spesifikasi" required>

Jumlah Stok:
<input type="number" name="qty" required>

Gambar:
<input type="file" name="gambaralat">

<button name="submit">Simpan</button>

</form>
</div>

</div>
</div>

</body>
</html>