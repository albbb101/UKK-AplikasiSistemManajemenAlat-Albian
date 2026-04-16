<?php
include 'config.php';
require_role('petugas');

$id = $_GET['id'];

// ambil data dulu
$data = $mysqli->query("
    SELECT * FROM peminjaman WHERE idpinjam='$id'
")->fetch_assoc();

// ❗ pastikan belum dikembalikan
if ($data && $data['status'] == 'menunggu konfirmasi') {

    $today = date('Y-m-d');

    // update status
    $mysqli->query("
    UPDATE peminjaman 
    SET status='dikembalikan',
        tglkembali='$today'
    WHERE idpinjam='$id'
    ");

    // ✅ BALIKIN STOK
    $mysqli->query("
    UPDATE alat 
    SET qty = qty + ".$data['qty']." 
    WHERE idalat='".$data['idalat']."'
    ");
}

header("Location: petugas_pengembalian.php");
exit;