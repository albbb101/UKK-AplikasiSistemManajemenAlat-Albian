<?php
include 'config.php';

$id = $_GET['id'];

unset($_SESSION['cart'][$id]);

header("Location: keranjang.php");
exit;