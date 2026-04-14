<?php
include 'config.php';

$id = $_GET['id'];

$mysqli->query("UPDATE peminjaman SET status='dikembalikan' WHERE idpinjam='$id'");

header("Location: petugas_pengembalian.php");