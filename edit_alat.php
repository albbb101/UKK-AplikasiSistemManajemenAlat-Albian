<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];
$data = $mysqli->query("SELECT * FROM alat WHERE idalat='$id'");
$row = $data->fetch_assoc();
$kategori = $mysqli->query("SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $idkategori = $_POST['idkategori'];
    $nama = $_POST['namaalat'];
    $spesifikasi = $_POST['spesifikasi'];
    $qty = $_POST['qty'];
    $gambar = $row['gambaralat'];

    if (!empty($_FILES['gambaralat']['name'])) {
        $filename = $_FILES['gambaralat']['name'];
        move_uploaded_file($_FILES['gambaralat']['tmp_name'], "uploads/" . $filename);
        $gambar = $filename;
    }

    $mysqli->query("UPDATE alat SET idkategori='$idkategori', namaalat='$nama', spesifikasi='$spesifikasi', gambaralat='$gambar', qty='$qty' WHERE idalat='$id'");
    header("Location: alat.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">
<?php include 'sidebar.php'; ?>
<div class="main">
    <div class="content">
        <h2>Edit Alat</h2>
        <div class="form-box" style="max-width: 500px;">
            <form method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">ID:</label>
                    <input type="text" value="<?= $row['idalat'] ?>" disabled style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #eee;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Kategori:</label>
                    <select name="idkategori" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                    <?php while ($k = $kategori->fetch_assoc()) { ?>
                        <option value="<?= $k['idkategori'] ?>" <?= $k['idkategori']==$row['idkategori']?'selected':'' ?>><?= $k['namakategori'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Nama:</label>
                    <input type="text" name="namaalat" value="<?= $row['namaalat'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Spesifikasi:</label>
                    <input type="text" name="spesifikasi" value="<?= $row['spesifikasi'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Stok:</label>
                    <input type="number" name="qty" value="<?= $row['qty'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label style="display: block; margin-bottom: 5px;">Gambar:</label>
                    <input type="file" name="gambaralat">
                </div>
                <?php if ($row['gambaralat']) { ?>
                    <img src="uploads/<?= $row['gambaralat'] ?>" width="80" style="margin-bottom: 15px; border-radius: 5px;">
                <?php } ?>
                <br>
                <button name="update" class="btn edit" style="padding: 10px 25px;">Update</button>
                <a href="alat.php" class="btn" style="background: #6c757d; padding: 10px 25px; margin-left: 10px; text-decoration: none; color: white;">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>