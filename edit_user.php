<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];
$user = $mysqli->query("SELECT * FROM users WHERE id='$id'")->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $namalengkap = $_POST['namalengkap'];
    $nohp = $_POST['nohp'];

    $identitas = $user['identitas'];

    if (!empty($_FILES['identitas']['name'])) {
        $filename = $_FILES['identitas']['name'];
        move_uploaded_file($_FILES['identitas']['tmp_name'], "uploads/" . $filename);
        $identitas = $filename;
    }

    $mysqli->query("UPDATE users SET
        name='$name',
        pass='$pass',
        role='$role',
        namalengkap='$namalengkap',
        identitas='$identitas',
        nohp='$nohp'
        WHERE id='$id'
    ");

    header("Location: users.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Edit User</h2>

<form method="POST" enctype="multipart/form-data">

Username:
<input type="text" name="name" value="<?= $user['name'] ?>">

Password:
<input type="text" name="pass" value="<?= $user['pass'] ?>">

Role:
<select name="role">
<option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
<option value="petugas" <?= $user['role']=='petugas'?'selected':'' ?>>Petugas</option>
<option value="peminjam" <?= $user['role']=='peminjam'?'selected':'' ?>>Peminjam</option>
</select>

Nama Lengkap:
<input type="text" name="namalengkap" value="<?= $user['namalengkap'] ?>">

No HP:
<input type="text" name="nohp" value="<?= $user['nohp'] ?>">

<input type="file" name="identitas">

<button name="update">Update</button>

</form>

</div>
</div>

</body>
</html>