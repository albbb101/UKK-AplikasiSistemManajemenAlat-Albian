<?php
include 'config.php';
require_role('admin');

$activePage = 'users';

// ================= DELETE =================
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // cek apakah user dipakai di peminjaman
    $cek = $mysqli->query("SELECT * FROM peminjaman WHERE iduser='$id'");

    if ($cek->num_rows > 0) {
        echo "<script>alert('User tidak bisa dihapus karena masih memiliki data peminjaman!'); window.location='users.php';</script>";
        exit;
    }

    $mysqli->query("DELETE FROM users WHERE id='$id'");
    header("Location: users.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Kelola User</h2>

<a href="add_user.php" class="btn add">Tambah User</a>

<table>
<tr>
    <th>Username</th>
    <th>Nama</th>
    <th>Role</th>
    <th>No HP</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['namalengkap'] ?></td>
    <td><?= $row['role'] ?></td>
    <td><?= $row['nohp'] ?></td>
    <td>
        <?php if ($row['identitas']) { ?>
            <img src="uploads/<?= $row['identitas'] ?>" width="50">
        <?php } ?>
    </td>
    <td>
        <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>

        <a href="users.php?delete=<?= $row['id'] ?>"
           class="btn delete"
           onclick="return confirm('Yakin hapus user ini?')">
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