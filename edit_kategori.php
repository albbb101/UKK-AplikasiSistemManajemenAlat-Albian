<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];
$data = $mysqli->query("SELECT * FROM kategori WHERE idkategori='$id'");
$row = $data->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['namakategori'];

    $mysqli->query("UPDATE kategori SET
        namakategori='$nama'
        WHERE idkategori='$id'
    ");

    header("Location: kategori.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Kategori</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Edit Kategori</h2>

<div class="form-box">
<form method="POST">

ID:
<input type="text" value="<?= $row['idkategori'] ?>" disabled>

Nama:
<input type="text" name="namakategori" value="<?= $row['namakategori'] ?>">

<button name="update">Update</button>

</form>
</div>

</div>
</div>

</body>
</html>