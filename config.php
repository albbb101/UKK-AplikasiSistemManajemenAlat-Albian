<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'UKK2026_ALBIAN';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("DB Connection Error: " . $mysqli->connect_error);
}

function require_login() {
    if (empty($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
}

function require_role($role) {
    require_login();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("HTTP/1.1 403 Forbidden");
        echo "<h3>403 - Forbidden</h3><p>No access.</p>";
        exit;
    }
}

function log_activity($aktivitas) {
    global $mysqli;

    $username = $_SESSION['name'] ?? 'unknown';
    $role = $_SESSION['role'] ?? 'unknown';

    if ($aktivitas == 'Login') {
        $desc = "$username logged in";
    } else {
        $desc = "$username logged out";
    }

    $mysqli->query("INSERT INTO logaktivitas 
    (username, role, aktivitas, deskripsi)
    VALUES ('$username', '$role', '$aktivitas', '$desc')");
}