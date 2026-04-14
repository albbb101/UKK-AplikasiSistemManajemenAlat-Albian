<?php
include 'config.php';

$id = $_GET['id'];

$mysqli->query("UPDATE peminjaman SET status='ditolak' WHERE idpinjam='$id'");

header("Location: petugas_peminjaman.php");