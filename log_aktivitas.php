<?php
include 'config.php';
require_role('admin');

// FILTER
$where = "WHERE 1=1";

if (!empty($_GET['aktivitas']) && $_GET['aktivitas'] != 'Semua') {
    $a = $_GET['aktivitas'];
    $where .= " AND aktivitas='$a'";
}

if (!empty($_GET['start'])) {
    $where .= " AND DATE(waktu) >= '".$_GET['start']."'";
}

if (!empty($_GET['end'])) {
    $where .= " AND DATE(waktu) <= '".$_GET['end']."'";
}

$query = "SELECT * FROM logaktivitas $where ORDER BY waktu DESC";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Aktivitas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Log Aktivitas</h2>

<!-- FILTER -->
<div class="form-box">
<form method="GET">

Tipe Aktivitas:
<select name="aktivitas">
    <option>Semua</option>
    <option>Login</option>
    <option>Logout</option>
</select>

Tanggal Mulai:
<input type="date" name="start">

Tanggal Akhir:
<input type="date" name="end">

<button type="submit">Terapkan Filter</button>
<a href="log_aktivitas.php" class="btn">Reset</a>

</form>
</div>

<!-- TABLE -->
<table>
<tr>
    <th>Waktu</th>
    <th>Username</th>
    <th>Role</th>
    <th>Tipe Aktivitas</th>
    <th>Deskripsi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['waktu'] ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['role'] ?></td>
    <td><?= $row['aktivitas'] ?></td>
    <td><?= $row['deskripsi'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>