<?php
include 'config.php';
require_role('peminjam');

$iduser = $_SESSION['id'];

$query = "
SELECT p.*, a.namaalat 
FROM peminjaman p
JOIN alat a ON p.idalat = a.idalat
WHERE p.iduser='$iduser'
ORDER BY p.idpinjam DESC
";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman Saya</title>
</head>
<body>

<?php include 'navbar_user.php'; ?>

<div style="padding:20px;">
<h2>Peminjaman Saya</h2>

<?php while ($row = $result->fetch_assoc()) { ?>
<div style="border:1px solid #ccc; margin:10px; padding:10px;">
    <h3><?= $row['namaalat'] ?></h3>
    <p>Jumlah: <?= $row['qty'] ?></p>
    <p>Status: <?= $row['status'] ?></p>
</div>
<?php } ?>

</div>

</body>
</html>