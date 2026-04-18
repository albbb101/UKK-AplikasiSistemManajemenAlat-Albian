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

    $cek = $mysqli->query("SELECT * FROM users WHERE (name='$name' OR nohp='$nohp') AND id != '$id'");

    if ($cek->num_rows > 0) {
        echo "<script>alert('Username atau No HP sudah digunakan!');</script>";
    } else {
        $identitas = $user['identitas'];
        if (!empty($_FILES['identitas']['name'])) {
            $filename = $_FILES['identitas']['name'];
            move_uploaded_file($_FILES['identitas']['tmp_name'], "uploads/" . $filename);
            $identitas = $filename;
        }
        $mysqli->query("UPDATE users SET name='$name', pass='$pass', role='$role', namalengkap='$namalengkap', identitas='$identitas', nohp='$nohp' WHERE id='$id'");
        header("Location: users.php");
        exit;
    }
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

        <div class="form-box" style="max-width: 500px;">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Username:</label>
                    <input type="text" name="name" value="<?= $user['name'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Password:</label>
                    <input type="text" name="pass" value="<?= $user['pass'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Role:</label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                        <option value="petugas" <?= $user['role']=='petugas'?'selected':'' ?>>Petugas</option>
                        <option value="peminjam" <?= $user['role']=='peminjam'?'selected':'' ?>>Peminjam</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Nama Lengkap:</label>
                    <input type="text" name="namalengkap" value="<?= $user['namalengkap'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">No HP:</label>
                    <input type="text" name="nohp" value="<?= $user['nohp'] ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px;">Foto:</label>
                    <input type="file" name="identitas">
                </div>

                <div style="margin-top: 20px;">
                    <button name="update" class="btn edit" style="padding: 10px 25px; color: white;">Update</button>
                    <a href="users.php" class="btn" style="background: #6c757d; padding: 10px 25px; margin-left: 10px; text-decoration: none; color: white;">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>