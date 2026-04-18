<?php
include 'config.php';
require_role('admin');

if (isset($_POST['submit'])) {
    $id = $_POST['idkategori'];
    $nama = $_POST['namakategori'];
    $mysqli->query("INSERT INTO kategori (idkategori, namakategori) VALUES ('$id','$nama')");
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
    <div class="form-box" style="max-width: 500px;">
        <form method="POST">
            <div style="margin-bottom: 15px;">
                ID:<br>
                <input type="text" name="idkategori" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                Nama Kategori:<br>
                <input type="text" name="namakategori" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <button name="submit" class="btn add">Simpan</button>
            <a href="kategori.php" class="btn" style="background: #6c757d; margin-left: 5px;">Kembali</a>
        </form>
    </div>
</div>
</div>
</body>
</html>