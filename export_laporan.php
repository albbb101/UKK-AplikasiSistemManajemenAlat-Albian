<?php
include 'config.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan.xls");

$result = $mysqli->query("
SELECT p.*, u.namalengkap AS peminjam, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Peminjam</th>
<th>Alat</th>
<th>Qty</th>
<th>Status</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['idpinjam']}</td>
    <td>{$row['peminjam']}</td>
    <td>{$row['namaalat']}</td>
    <td>{$row['qty']}</td>
    <td>{$row['status']}</td>
    </tr>";
}

echo "</table>";