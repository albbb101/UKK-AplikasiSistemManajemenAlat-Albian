<?php
include 'config.php';
require_role('admin');

$users = $mysqli->query("SELECT * FROM users WHERE role='peminjam'");
$alat  = $mysqli->query("SELECT * FROM alat");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $iduser = $_POST['iduser'] ?? '';
    $idalat = $_POST['idalat'] ?? '';
    $tgl    = $_POST['tglpinjam'] ?? '';
    $qty    = $_POST['qty'] ?? 0;

    if ($iduser && $idalat && $tgl && $qty > 0) {

        $cek = $mysqli->query("SELECT qty FROM alat WHERE idalat='$idalat'");
        $data = $cek->fetch_assoc();

        if ($data['qty'] < $qty) {
            echo "<script>alert('Stok tidak cukup!');</script>";
        } else {

            $mysqli->query("
                INSERT INTO peminjaman 
                (tglpinjam, tglkembali, idalat, qty, iduser, kondisiakhir, status)
                VALUES (
                    '$tgl',
                    NULL,
                    '$idalat',
                    '$qty',
                    '$iduser',
                    '',
                    'dipinjam'
                )
            ");

            $mysqli->query("
                UPDATE alat 
                SET qty = qty - $qty 
                WHERE idalat='$idalat'
            ");

            header("Location: peminjaman.php");
            exit;
        }
    }
}

$query = "
SELECT p.*, u.namalengkap, a.namaalat
FROM peminjaman p
JOIN users u ON p.iduser = u.id
JOIN alat a ON p.idalat = a.idalat
ORDER BY p.idpinjam DESC
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php $activePage = 'peminjaman'; ?>
<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Peminjaman</h2>

<div class="form-box">
<form method="POST">

Peminjam:
<select name="iduser">
<?php while ($u = $users->fetch_assoc()) { ?>
<option value="<?= $u['id'] ?>"><?= $u['namalengkap'] ?></option>
<?php } ?>
</select>

Alat:
<select name="idalat">
<?php while ($a = $alat->fetch_assoc()) { ?>
<option value="<?= $a['idalat'] ?>">
<?= $a['namaalat'] ?> (stok: <?= $a['qty'] ?>)
</option>
<?php } ?>
</select>

Tanggal:
<input type="date" name="tglpinjam" required>

Jumlah:
<input type="number" name="qty" required>

<button class="btn add" type="submit">
    Tambah Peminjaman
</button>

</form>
</div>

<table>
<tr>
    <th>ID</th>
    <th>Peminjam</th>
    <th>Alat</th>
    <th>Qty</th>
    <th>Tanggal Pinjam</th>
    <th>Status</th>
    <th>Kondisi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['idpinjam'] ?></td>
    <td><?= $row['namalengkap'] ?></td>
    <td><?= $row['namaalat'] ?></td>
    <td><?= $row['qty'] ?></td>
    <td><?= $row['tglpinjam'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['kondisiakhir'] ?: '-' ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>