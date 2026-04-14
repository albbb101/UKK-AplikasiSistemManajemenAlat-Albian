<?php
include 'config.php';

$id = $_GET['id'];

$mysqli->query("UPDATE peminjaman SET status='dipinjam' WHERE idpinjam='$id'");

header("Location: petugas_peminjaman.php");