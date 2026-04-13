<?php
include 'config.php';
require_role('admin');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $namalengkap = $_POST['namalengkap'];
    $nohp = $_POST['nohp'];

    $identitas = '';

    if (!empty($_FILES['identitas']['name'])) {
        $filename = $_FILES['identitas']['name'];
        move_uploaded_file($_FILES['identitas']['tmp_name'], "uploads/" . $filename);
        $identitas = $filename;
    }

    $mysqli->query("INSERT INTO users (id, name, pass, role, namalengkap, identitas, nohp)
                    VALUES ('$id','$name','$pass','$role','$namalengkap','$identitas','$nohp')");

    header("Location: users.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah User</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Tambah User</h2>

<div class="form-box">
<form method="POST" enctype="multipart/form-data">

ID:
<input type="text" name="id" required>

Username:
<input type="text" name="name" required>

Password:
<input type="text" name="pass" required>

Role:
<select name="role">
<option value="admin">Admin</option>
<option value="petugas">Petugas</option>
<option value="peminjam">Peminjam</option>
</select>

Nama Lengkap:
<input type="text" name="namalengkap" required>

No HP:
<input type="text" name="nohp" required>

Foto:
<input type="file" name="identitas">

<button name="submit">Simpan</button>

</form>
</div>

</div>
</div>

</body>
</html>