<?php
include 'config.php';
require_role('petugas');

$result = $mysqli->query("
SELECT p.*, u.username, a.namaalat
FROM peminjaman p
JOIN user u ON p.iduser = u.iduser
JOIN alat a ON p.idalat = a.idalat
WHERE p.status='dipinjam'
");
?>

<!DOCTYPE html>
<html>
<body>

<?php include 'sidebar_petugas.php'; ?>

<div style="margin-left:220px; padding:20px;">

<h2>Pengembalian</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>User</th>
<th>Alat</th>
<th>Qty</th>
<th>Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['idpinjam'] ?></td>
<td><?= $row['username'] ?></td>
<td><?= $row['namaalat'] ?></td>
<td><?= $row['qty'] ?></td>

<td>
<a href="kembali.php?id=<?= $row['idpinjam'] ?>">Konfirmasi</a>
</td>

</tr>
<?php } ?>

</table>

</div>

</body>
</html>