<?php
include 'config.php';
require_role('admin');

$query = "
SELECT alatmasuk.*, alat.namaalat, kategori.namakategori
FROM alatmasuk
JOIN alat ON alatmasuk.idalat = alat.idalat
JOIN kategori ON alat.idkategori = kategori.idkategori
ORDER BY tglmasuk DESC
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alat Masuk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Alat Masuk</h2>

<a href="add_alat_masuk.php" class="btn add">Tambah Alat Masuk</a>

<table>
<tr>
    <th>Tanggal</th>
    <th>Nama Alat</th>
    <th>Kategori</th>
    <th>Jumlah</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['tglmasuk'] ?></td>
    <td><?= $row['namaalat'] ?></td>
    <td><?= $row['namakategori'] ?></td>
    <td>+<?= $row['qty'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>