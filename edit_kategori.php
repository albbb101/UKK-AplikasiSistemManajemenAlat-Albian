<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];
$data = $mysqli->query("SELECT * FROM kategori WHERE idkategori='$id'");
$row = $data->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['namakategori'];
    $mysqli->query("UPDATE kategori SET namakategori='$nama' WHERE idkategori='$id'");
    header("Location: kategori.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">
<?php include 'sidebar.php'; ?>
<div class="main">
<div class="content">
    <h2>Edit Kategori</h2>
    <div class="form-box" style="max-width: 500px;">
        <form method="POST">
            <div style="margin-bottom: 15px;">
                ID:<br>
                <input type="text" value="<?= $row['idkategori'] ?>" disabled style="width: 100%; padding: 8px; background: #eee; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                Nama:<br>
                <input type="text" name="namakategori" value="<?= $row['namakategori'] ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <button name="update" class="btn edit">Update</button>
            <a href="kategori.php" class="btn" style="background: #6c757d; margin-left: 5px;">Kembali</a>
        </form>
    </div>
</div>
</div>
</body>
</html>