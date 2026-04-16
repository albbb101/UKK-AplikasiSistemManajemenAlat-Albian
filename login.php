<?php
include 'config.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $query = "SELECT * FROM users WHERE name='$name' AND pass='$pass'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("SQL Error: " . $mysqli->error);
    }

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        log_activity("Login");

        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
            exit;
        } elseif ($user['role'] === 'petugas') {
            header("Location: petugas_dashboard.php");
            exit;
        } else {
            header("Location: peminjam_dashboard.php");
            exit;
        }

    } else {
        $error = "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Aplikasi Peminjaman Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-body">

<div class="login-wrapper">

    <div class="login-card">

        <a href="index.php" class="back-btn">← Kembali</a>

        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="login-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" required>
            </div>

            <button type="submit">Masuk</button>

        </form>

    </div>

</div>

</body>
</html>