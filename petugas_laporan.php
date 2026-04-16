<?php
include 'config.php';
require_role('petugas');

$tgl1 = $_GET['tgl1'] ?? '';
$tgl2 = $_GET['tgl2'] ?? '';
$status = $_GET['status'] ?? '';

$where = "WHERE 1=1";

if ($tgl1 && $tgl2) {
    $where .= " AND p.tglpinjam BETWEEN '$tgl1' AND '$tgl2'";
}

if ($status) {
    $where .= " AND p.status='$status'";
}

$result = $mysqli->query("
SELECT p.*, u.namalengkap AS peminjam, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
$where
ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html>
<body>

<?php include 'sidebar_petugas.php'; ?>

<div style="margin-left:220px; padding:20px;">

<h2>Laporan</h2>

<!-- FILTER -->
<form method="GET">
    Dari: <input type="date" name="tgl1" value="<?= $tgl1 ?>">
    Sampai: <input type="date" name="tgl2" value="<?= $tgl2 ?>">

    Status:
    <select name="status">
        <option value="">Semua</option>
        <option value="menunggu">Menunggu</option>
        <option value="disetujui">Disetujui</option>
        <option value="dipinjam">Dipinjam</option>
        <option value="menunggu konfirmasi">Menunggu Konfirmasi</option>
        <option value="dikembalikan">Dikembalikan</option>
        <option value="ditolak">Ditolak</option>
    </select>

    <button type="submit">Filter</button>
</form>

<br>

<!-- EXPORT (PASS FILTER) -->
<a href="export_laporan.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>&status=<?= $status ?>">
    Download Laporan
</a>

<br><br>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Peminjam</th>
<th>Alat</th>
<th>Qty</th>
<th>Tgl Pinjam</th>
<th>Tgl Kembali</th>
<th>Status</th>
<th>Kondisi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['idpinjam'] ?></td>
<td><?= $row['peminjam'] ?></td>
<td><?= $row['namaalat'] ?></td>
<td><?= $row['qty'] ?></td>
<td><?= $row['tglpinjam'] ?></td>
<td><?= $row['tglkembali'] ?? '-' ?></td>
<td><?= $row['status'] ?></td>
<td><?= $row['kondisiakhir'] ?: '-' ?></td>
</tr>
<?php } ?>

</table>

</div>
</body>
</html>