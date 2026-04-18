<?php
include 'config.php';
require_role('admin');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $namalengkap = $_POST['namalengkap'];
    $nohp = $_POST['nohp'];

    $cek = $mysqli->query("SELECT * FROM users WHERE name='$name' OR nohp='$nohp'");

    if ($cek->num_rows > 0) {
        echo "<script>alert('Username atau No HP sudah digunakan!');</script>";
    } else {
        $identitas = '';
        if (!empty($_FILES['identitas']['name'])) {
            $filename = $_FILES['identitas']['name'];
            move_uploaded_file($_FILES['identitas']['tmp_name'], "uploads/" . $filename);
            $identitas = $filename;
        }
        $mysqli->query("INSERT INTO users (name, pass, role, namalengkap, identitas, nohp)
                        VALUES ('$name','$pass','$role','$namalengkap','$identitas','$nohp')");
        header("Location: users.php");
        exit;
    }
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

        <div class="form-box" style="max-width: 500px;">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Username:</label>
                    <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Password:</label>
                    <input type="text" name="pass" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Role:</label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="peminjam">Peminjam</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Nama Lengkap:</label>
                    <input type="text" name="namalengkap" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">No HP:</label>
                    <input type="text" name="nohp" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px;">Foto:</label>
                    <input type="file" name="identitas">
                </div>

                <div style="margin-top: 20px;">
                    <button name="submit" class="btn add" style="padding: 10px 25px;">Simpan</button>
                    <a href="users.php" class="btn" style="background: #6c757d; padding: 10px 25px; margin-left: 10px; text-decoration: none; color: white;">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>