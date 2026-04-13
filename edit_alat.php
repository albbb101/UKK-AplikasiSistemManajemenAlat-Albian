<?php
include 'config.php';
require_role('admin');

$id = $_GET['id'];

$data = $mysqli->query("SELECT * FROM alat WHERE idalat='$id'");
$row = $data->fetch_assoc();

$kategori = $mysqli->query("SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $idkategori = $_POST['idkategori'];
    $nama = $_POST['namaalat'];
    $spesifikasi = $_POST['spesifikasi'];
    $qty = $_POST['qty'];

    $gambar = $row['gambaralat'];

    if (!empty($_FILES['gambaralat']['name'])) {
        $filename = $_FILES['gambaralat']['name'];
        move_uploaded_file($_FILES['gambaralat']['tmp_name'], "uploads/" . $filename);
        $gambar = $filename;
    }

    $mysqli->query("UPDATE alat SET
        idkategori='$idkategori',
        namaalat='$nama',
        spesifikasi='$spesifikasi',
        gambaralat='$gambar',
        qty='$qty'
        WHERE idalat='$id'
    ");

    header("Location: alat.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Alat</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
<div class="content">

<h2>Edit Alat</h2>

<div class="form-box">
<form method="POST" enctype="multipart/form-data">

ID:
<input type="text" value="<?= $row['idalat'] ?>" disabled>

Kategori:
<select name="idkategori">
<?php while ($k = $kategori->fetch_assoc()) { ?>
    <option value="<?= $k['idkategori'] ?>" 
    <?= $k['idkategori']==$row['idkategori']?'selected':'' ?>>
        <?= $k['namakategori'] ?>
    </option>
<?php } ?>
</select>

Nama:
<input type="text" name="namaalat" value="<?= $row['namaalat'] ?>">

Spesifikasi:
<input type="text" name="spesifikasi" value="<?= $row['spesifikasi'] ?>">

Stok:
<input type="number" name="qty" value="<?= $row['qty'] ?>">

Gambar:
<input type="file" name="gambaralat">

<br><br>
<?php if ($row['gambaralat']) { ?>
<img src="uploads/<?= $row['gambaralat'] ?>" width="100">
<?php } ?>

<button name="update">Update</button>

</form>
</div>

</div>
</div>

</body>
</html>