<?php
include 'config.php';
require_role('admin');

$query = "
SELECT p.*, u.namalengkap, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
WHERE p.status = 'dikembalikan'
ORDER BY p.tglkembali DESC
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Pengembalian</h2>

<table>
<tr>
    <th>ID</th>
    <th>Peminjam</th>
    <th>Alat</th>
    <th>Qty</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Kondisi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['idpinjam'] ?></td>
    <td><?= $row['namalengkap'] ?></td>
    <td><?= $row['namaalat'] ?></td>
    <td><?= $row['qty'] ?></td>
    <td><?= $row['tglpinjam'] ?></td>
    <td><?= $row['tglkembali'] ?></td>
    <td><?= $row['kondisiakhir'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>