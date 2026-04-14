<?php
include 'config.php';
require_role('petugas');
?>

<!DOCTYPE html>
<html>
<body>

<?php include 'sidebar_petugas.php'; ?>

<div style="margin-left:220px; padding:20px;">
<h2>Dashboard Petugas</h2>
<p>Selamat datang, <?= $_SESSION['name'] ?></p>
</div>

</body>
</html>