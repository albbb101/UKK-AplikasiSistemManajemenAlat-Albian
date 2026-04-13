<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM users WHERE name='$name' AND pass='$pass'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['id']   = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // LOG LOGIN
        log_activity("Login");

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($user['role'] == 'petugas') {
            header("Location: petugas_dashboard.php");
        } else {
            header("Location: peminjam_dashboard.php");
        }
        exit;

    } else {
        $error = "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        Username:
        <input type="text" name="name" required>

        Password:
        <input type="password" name="pass" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>