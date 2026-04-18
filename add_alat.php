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

    $mysqli->query("INSERT INTO alat (idalat, idkategori, namaalat, spesifikasi, gambaralat, qty)
                    VALUES ('$id','$idkategori','$nama','$spesifikasi','$gambar','$qty')");

    header("Location: alat.php");
    exit;
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
        <div class="form-box" style="max-width: 500px;">
            <form method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">ID Alat:</label>
                    <input type="text" name="idalat" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Kategori:</label>
                    <select name="idkategori" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                    <?php while ($k = $kategori->fetch_assoc()) { ?>
                        <option value="<?= $k['idkategori'] ?>"><?= $k['namakategori'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Nama Alat:</label>
                    <input type="text" name="namaalat" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Spesifikasi:</label>
                    <input type="text" name="spesifikasi" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Jumlah Stok:</label>
                    <input type="number" name="qty" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px;">Gambar:</label>
                    <input type="file" name="gambaralat">
                </div>
                <button name="submit" class="btn add" style="padding: 10px 25px;">Simpan</button>
                <a href="alat.php" class="btn" style="background: #6c757d; padding: 10px 25px; margin-left: 10px; text-decoration: none; color: white;">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>