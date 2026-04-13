<?php
include 'config.php';
require_role('admin');

$alat = $mysqli->query("SELECT * FROM alat");

if (isset($_POST['submit'])) {
    $idalat = $_POST['idalat'];
    $tgl = $_POST['tglmasuk'];
    $qty = $_POST['qty'];

    $mysqli->query("INSERT INTO alatmasuk (tglmasuk, idalat, qty)
                    VALUES ('$tgl','$idalat','$qty')");

    header("Location: alat_masuk.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Alat Masuk</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Tambah Alat Masuk</h2>

<div class="form-box">
<form method="POST">

Alat:
<select name="idalat">
<?php while ($a = $alat->fetch_assoc()) { ?>
    <option value="<?= $a['idalat'] ?>">
        <?= $a['namaalat'] ?>
    </option>
<?php } ?>
</select>

Tanggal:
<input type="date" name="tglmasuk" required>

Jumlah:
<input type="number" name="qty" required>

<button name="submit">Simpan</button>

</form>
</div>

</div>
</div>

</body>
</html>