<?php
include 'config.php';

$id = $_GET['id'];

$mysqli->query("
UPDATE peminjaman 
SET status='menunggu konfirmasi' 
WHERE idpinjam='$id'
");

header("Location: peminjaman_user.php");
exit;