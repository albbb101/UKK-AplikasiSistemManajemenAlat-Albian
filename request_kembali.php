<?php
include 'config.php';
require_role('peminjam');

$id = $_POST['id'] ?? '';
$kondisi = $_POST['kondisiakhir'] ?? '';

if ($id && $kondisi) {

    $mysqli->query("
    UPDATE peminjaman 
    SET status='menunggu konfirmasi',
        kondisiakhir='$kondisi'
    WHERE idpinjam='$id'
    ");

}

header("Location: peminjaman_user.php");
exit;