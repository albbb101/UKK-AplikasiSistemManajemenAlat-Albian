<?php
include 'config.php';
require_role('admin');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM alat WHERE idalat='$id'");
    header("Location: alat.php");
    exit;
}

$query = "
SELECT alat.*, kategori.namakategori 
FROM alat 
JOIN kategori ON alat.idkategori = kategori.idkategori
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Kelola Alat</h2>

<a href="add_alat.php" class="btn add">Tambah Alat</a>

<table>
<tr>
    <th>ID</th>
    <th>Kategori</th>
    <th>Nama</th>
    <th>Spesifikasi</th>
    <th>Stok</th>
    <th>Gambar</th>
    <th>Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['idalat'] ?></td>
    <td><?= $row['namakategori'] ?></td>
    <td><?= $row['namaalat'] ?></td>
    <td><?= $row['spesifikasi'] ?></td>
    <td><?= $row['qty'] ?></td>
    <td>
        <?php if ($row['gambaralat']) { ?>
            <img src="uploads/<?= $row['gambaralat'] ?>" width="60">
        <?php } ?>
    </td>
    <td>
        <a href="edit_alat.php?id=<?= $row['idalat'] ?>" class="btn edit">Edit</a>
        <a href="alat.php?delete=<?= $row['idalat'] ?>" 
           class="btn delete"
           onclick="return confirm('Yakin hapus alat ini?')">
           Hapus
        </a>
    </td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>