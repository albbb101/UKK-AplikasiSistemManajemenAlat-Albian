<?php
include 'config.php';
if (!isset($_SESSION)) session_start(); 
require_role('peminjam');

// Set identifier for navbar
$activePage = 'katalog'; 

$result = $mysqli->query("SELECT alat.*, kategori.namakategori FROM alat LEFT JOIN kategori ON alat.idkategori = kategori.idkategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'navbar_user.php'; ?>

    <div class="main" style="padding: 40px;">
        <div class="content">
            <h2 style="margin-bottom: 20px;">Katalog Alat</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="card" style="display: flex; flex-direction: column; border: 1px solid #eee;">
                    <?php if ($row['gambaralat']) { ?>
                        <img src="uploads/<?= $row['gambaralat'] ?>" style="width:100%; height:180px; object-fit:cover; border-radius:8px; margin-bottom:15px;">
                    <?php } ?>

                    <h3 style="margin: 0; color: #1f2a6d;"><?= $row['namaalat'] ?></h3>
                    <p style="font-size: 12px; color: #888; margin: 5px 0;"><?= $row['namakategori'] ?? 'Tanpa Kategori' ?></p>
                    <p style="font-size: 14px; flex-grow: 1;"><?= $row['spesifikasi'] ?></p>
                    <p><strong>Stok:</strong> <?= $row['qty'] ?></p>

                    <button class="btn add" onclick="toggleForm('form<?= $row['idalat'] ?>')" style="width: 100%; margin-top: 10px;">
                        Pinjam Alat
                    </button>

                    <form id="form<?= $row['idalat'] ?>" method="POST" action="add_to_cart.php" style="display:none; margin-top:15px; background: #f9f9f9; padding: 10px; border-radius: 8px;">
                        <input type="hidden" name="idalat" value="<?= $row['idalat'] ?>">
                        <div class="form-group">
                            <label>Jumlah:</label>
                            <input type="number" name="qty" value="1" min="1" max="<?= $row['qty'] ?>" style="width:100%;">
                        </div>
                        <div class="form-group">
                            <label>Lama (Hari):</label>
                            <input type="number" name="lama" value="1" min="1" style="width:100%;">
                        </div>
                        <button type="submit" class="btn edit" style="width: 100%;">Tambah ke Keranjang</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
    function toggleForm(id) {
        var form = document.getElementById(id);
        form.style.display = (form.style.display === "none") ? "block" : "none";
    }
    </script>
</body>
</html>