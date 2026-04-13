<?php
include 'config.php';
require_role('admin');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM kategori WHERE idkategori='$id'");
    header("Location: kategori.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="content">

        <h2>Kelola Kategori</h2>

        <a href="add_kategori.php" class="btn add">Tambah Kategori</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['idkategori'] ?></td>
                <td><?= $row['namakategori'] ?></td>
                <td>
                    <a href="edit_kategori.php?id=<?= $row['idkategori'] ?>" class="btn edit">Edit</a>
                    <a href="kategori.php?delete=<?= $row['idkategori'] ?>" 
                       class="btn delete"
                       onclick="return confirm('Yakin hapus?')">
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