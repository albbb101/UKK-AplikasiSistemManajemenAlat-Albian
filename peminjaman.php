<?php
include 'config.php';
require_role('admin');

// ambil data dropdown
$users = $mysqli->query("SELECT * FROM users WHERE role='peminjam'");
$alat  = $mysqli->query("SELECT * FROM alat");

// ================= TAMBAH PEMINJAMAN =================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $iduser = $_POST['iduser'] ?? '';
    $idalat = $_POST['idalat'] ?? '';
    $tgl    = $_POST['tglpinjam'] ?? '';
    $qty    = $_POST['qty'] ?? 0;

    if ($iduser && $idalat && $tgl && $qty > 0) {

        // cek stok
        $cek = $mysqli->query("SELECT qty FROM alat WHERE idalat='$idalat'");
        $data = $cek->fetch_assoc();

        if ($data['qty'] < $qty) {
            echo "<script>alert('Stok tidak cukup!');</script>";
        } else {

            // insert
            $mysqli->query("INSERT INTO peminjaman 
            (tglpinjam, tglkembali, idalat, qty, iduser, kondisiakhir, status)
            VALUES ('$tgl', NULL, '$idalat', '$qty', '$iduser', NULL, 'dipinjam')");

            // kurangi stok
            $mysqli->query("UPDATE alat 
                SET qty = qty - $qty 
                WHERE idalat='$idalat'");

            header("Location: peminjaman.php");
            exit;
        }
    }
}

// ================= KEMBALIKAN (FIXED) =================
if (isset($_GET['kembali'])) {
    $id = $_GET['kembali'];

    $data = $mysqli->query("SELECT * FROM peminjaman WHERE idpinjam='$id'")->fetch_assoc();

    // ❗ STOP kalau sudah dikembalikan
    if ($data['status'] == 'dikembalikan') {
        header("Location: peminjaman.php");
        exit;
    }

    $today = date('Y-m-d');

    // update status
    $mysqli->query("UPDATE peminjaman SET
        status='dikembalikan',
        tglkembali='$today',
        kondisiakhir='baik'
        WHERE idpinjam='$id'
    ");

    // balikin stok (CUMA SEKALI)
    $mysqli->query("UPDATE alat 
        SET qty = qty + ".$data['qty']." 
        WHERE idalat='".$data['idalat']."'
    ");

    header("Location: peminjaman.php");
    exit;
}

// ================= AMBIL DATA =================
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

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Peminjaman</h2>

<!-- FORM -->
<div class="form-box">
<form method="POST">

Peminjam:
<select name="iduser">
<?php while ($u = $users->fetch_assoc()) { ?>
<option value="<?= $u['id'] ?>">
<?= $u['namalengkap'] ?>
</option>
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

<button type="submit">Tambah Peminjaman</button>

</form>
</div>

<!-- TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Peminjam</th>
    <th>Alat</th>
    <th>Qty</th>
    <th>Tanggal Pinjam</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['idpinjam'] ?></td>
    <td><?= $row['namalengkap'] ?></td>
    <td><?= $row['namaalat'] ?></td>
    <td><?= $row['qty'] ?></td>
    <td><?= $row['tglpinjam'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <?php if ($row['status'] == 'dipinjam') { ?>
            <a href="peminjaman.php?kembali=<?= $row['idpinjam'] ?>"
               class="btn edit"
               onclick="return confirm('Konfirmasi pengembalian?')">
               Kembalikan
            </a>
        <?php } else { echo "Selesai"; } ?>
    </td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>