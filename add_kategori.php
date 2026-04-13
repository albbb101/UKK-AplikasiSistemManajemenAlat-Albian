<?php
include 'config.php';
require_role('admin');

if (isset($_POST['submit'])) {
    $id = $_POST['idkategori'];
    $nama = $_POST['namakategori'];

    $mysqli->query("INSERT INTO kategori (idkategori, namakategori)
                    VALUES ('$id','$nama')");

    header("Location: kategori.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Kategori</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Tambah Kategori</h2>

<div class="form-box">
<form method="POST">

ID:
<input type="text" name="idkategori" required>

Nama Kategori:
<input type="text" name="namakategori" required>

<button name="submit">Simpan</button>

</form>
</div>

</div>
</div>

</body>
</html>