<?php
include 'config.php';

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

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan.xls");

$result = $mysqli->query("
SELECT p.*, u.namalengkap AS peminjam, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
$where
");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Peminjam</th>
<th>Alat</th>
<th>Qty</th>
<th>Tgl Pinjam</th>
<th>Tgl Kembali</th>
<th>Status</th>
<th>Kondisi</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['idpinjam']}</td>
    <td>{$row['peminjam']}</td>
    <td>{$row['namaalat']}</td>
    <td>{$row['qty']}</td>
    <td>{$row['tglpinjam']}</td>
    <td>{$row['tglkembali']}</td>
    <td>{$row['status']}</td>
    <td>{$row['kondisiakhir']}</td>
    </tr>";
}

echo "</table>";