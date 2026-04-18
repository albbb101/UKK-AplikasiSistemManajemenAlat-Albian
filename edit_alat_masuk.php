<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];

// Updated to use idmasuk
$data = $mysqli->query("SELECT * FROM alatmasuk WHERE idmasuk='$id'");
$row = $data->fetch_assoc();
$alat = $mysqli->query("SELECT * FROM alat");

if (isset($_POST['update'])) {
    $idalat = $_POST['idalat'];
    $tgl = $_POST['tglmasuk'];
    $qty = $_POST['qty'];

    // Updated to use idmasuk in the WHERE clause
    $mysqli->query("UPDATE alatmasuk SET idalat='$idalat', tglmasuk='$tgl', qty='$qty' WHERE idmasuk='$id'");

    header("Location: alat_masuk.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Alat Masuk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">
<?php include 'sidebar.php'; ?>
<div class="main">
    <div class="content">
        <h2>Edit Riwayat Alat Masuk</h2>
        <div class="form-box" style="max-width: 500px;">
            <form method="POST">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Alat:</label>
                    <select name="idalat" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                    <?php while ($a = $alat->fetch_assoc()) { ?>
                        <option value="<?= $a['idalat'] ?>" <?= $a['idalat']==$row['idalat']?'selected':'' ?>><?= $a['namaalat'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Tanggal:</label>
                    <input type="date" name="tglmasuk" value="<?= $row['tglmasuk'] ?>" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px;">Jumlah:</label>
                    <input type="number" name="qty" value="<?= $row['qty'] ?>" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                </div>
                <button name="update" class="btn edit" style="padding: 10px 25px;">Update</button>
                <a href="alat_masuk.php" class="btn" style="background: #6c757d; padding: 10px 25px; margin-left: 10px; text-decoration: none; color: white;">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>