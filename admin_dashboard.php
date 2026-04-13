<?php
include 'config.php';
require_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="layout">

<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="content">

        <h2>Dashboard Admin</h2>

        <p>Welcome, <?= $_SESSION['name']; ?> </p>

    </div>
</div>

</body>
</html>