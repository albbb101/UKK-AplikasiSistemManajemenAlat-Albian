<?php
include 'config.php';
require_role('petugas');

$id = $_GET['id'];

// ambil data peminjaman
$data = $mysqli->query("
    SELECT * FROM peminjaman WHERE idpinjam='$id'
")->fetch_assoc();

if ($data && $data['status'] == 'disetujui') {

    // kurangi stok
    $mysqli->query("
        UPDATE alat 
        SET qty = qty - ".$data['qty']." 
        WHERE idalat='".$data['idalat']."'
    ");

    // update status
    $mysqli->query("
        UPDATE peminjaman 
        SET status='dipinjam' 
        WHERE idpinjam='$id'
    ");
}

header("Location: petugas_peminjaman.php");
exit;