<?php
include 'config.php';
require_role('admin');

/* IMPORTANT: set this BEFORE sidebar */
$activePage = 'users';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // safer delete (basic improvement)
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

<!-- SIDEBAR (reads $activePage) -->
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
                       onclick="return confirm('Delete this user?')">
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