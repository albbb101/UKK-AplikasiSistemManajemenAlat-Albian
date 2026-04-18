<?php
include 'config.php';
require_role('admin');

// ================= DELETE LOGIC =================
if (isset($_GET['delete_id'])) {
    $id_hapus = $_GET['delete_id'];
    
    // Updated to use your actual column name: idmasuk
    $mysqli->query("DELETE FROM alatmasuk WHERE idmasuk='$id_hapus'");
    
    header("Location: alat_masuk.php");
    exit;
}

// Fetch data for the table
$query = "
SELECT alatmasuk.*, alat.namaalat, kategori.namakategori
FROM alatmasuk
JOIN alat ON alatmasuk.idalat = alat.idalat
JOIN kategori ON alat.idkategori = kategori.idkategori
ORDER BY tglmasuk DESC
";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alat Masuk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="layout">

<?php $activePage = 'alatmasuk'; ?>
<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="content">
        <h2 style="margin-bottom: 5px;">Riwayat Alat Masuk</h2>
        <p style="font-size: 13px; color: #666; margin-bottom: 20px;">*Catatan: Menambah atau menghapus di sini tidak akan merubah stok utama pada menu Alat.</p>
        
        <a href="add_alat_masuk.php" class="btn add" style="padding: 10px 20px; text-decoration: none; display: inline-block; margin-bottom: 20px;">Tambah Alat Masuk</a>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { 
                    // Using your specific column name idmasuk
                    $id_key = $row['idmasuk']; 
                ?>
                <tr>
                    <td><?= $row['tglmasuk'] ?></td>
                    <td><?= $row['namaalat'] ?></td>
                    <td><?= $row['namakategori'] ?></td>
                    <td style="color: green; font-weight: bold;">+<?= $row['qty'] ?></td>
                    <td style="text-align: center;">
                        <a href="edit_alat_masuk.php?id=<?= $id_key ?>" class="btn edit" style="padding: 5px 15px; text-decoration: none;">Edit</a>
                        <a href="alat_masuk.php?delete_id=<?= $id_key ?>" class="btn delete" style="padding: 5px 15px; text-decoration: none;" onclick="return confirm('Hapus riwayat ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>