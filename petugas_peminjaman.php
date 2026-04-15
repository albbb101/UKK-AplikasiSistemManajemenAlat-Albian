<?php
include 'config.php';
require_role('petugas');

$result = $mysqli->query("
SELECT p.*, u.namalengkap AS peminjam, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html>
<body>

<?php include 'sidebar_petugas.php'; ?>

<div style="margin-left:220px; padding:20px;">

<h2>Peminjaman</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Peminjam</th>
<th>Alat</th>
<th>Qty</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['idpinjam'] ?></td>
<td><?= $row['peminjam'] ?></td>
<td><?= $row['namaalat'] ?></td>
<td><?= $row['qty'] ?></td>
<td><?= $row['status'] ?></td>

<td>

<?php if ($row['status'] == 'menunggu') { ?>
<a href="approve.php?id=<?= $row['idpinjam'] ?>">Approve</a>
<a href="reject.php?id=<?= $row['idpinjam'] ?>">Reject</a>

<?php } elseif ($row['status'] == 'disetujui') { ?>
<a href="ambil.php?id=<?= $row['idpinjam'] ?>">Ambil</a>

<?php } else { ?>
-
<?php } ?>

</td>

</tr>
<?php } ?>

</table>

</div>

</body>
</html>