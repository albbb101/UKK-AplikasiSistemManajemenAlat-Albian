<?php
include 'config.php';
require_role('petugas');
$activePage = 'laporan'; // Sets the active link in sidebar

$tgl1 = $_GET['tgl1'] ?? '';
$tgl2 = $_GET['tgl2'] ?? '';
$status = $_GET['status'] ?? '';

$where = "WHERE 1=1";

if ($tgl1 && $tgl2) {
    $t1 = $mysqli->real_escape_string($tgl1);
    $t2 = $mysqli->real_escape_string($tgl2);
    $where .= " AND p.tglpinjam BETWEEN '$t1' AND '$t2'";
}

if ($status) {
    $st = $mysqli->real_escape_string($status);
    $where .= " AND p.status='$st'";
}

$result = $mysqli->query("
    SELECT p.*, u.namalengkap AS peminjam, a.namaalat
    FROM peminjaman p
    JOIN users u ON p.iduser = u.id
    JOIN alat a ON p.idalat = a.idalat
    $where
    ORDER BY p.idpinjam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Small tweaks for the filter form inline layout */
        .filter-form {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .filter-form div {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .filter-form label {
            font-size: 12px;
            font-weight: bold;
            color: #1f2a6d;
        }
        .filter-form input, .filter-form select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body class="layout">

<?php include 'sidebar_petugas.php'; ?>

<div class="main">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0;">Laporan Peminjaman</h2>
            <a href="export_laporan.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>&status=<?= $status ?>" class="btn edit">
                📥 Download Excel
            </a>
        </div>

        <form method="GET" class="filter-form">
            <div>
                <label>Dari Tanggal:</label>
                <input type="date" name="tgl1" value="<?= $tgl1 ?>">
            </div>
            <div>
                <label>Sampai Tanggal:</label>
                <input type="date" name="tgl2" value="<?= $tgl2 ?>">
            </div>
            <div>
                <label>Status:</label>
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="menunggu" <?= $status == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                    <option value="disetujui" <?= $status == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                    <option value="dipinjam" <?= $status == 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                    <option value="menunggu konfirmasi" <?= $status == 'menunggu konfirmasi' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                    <option value="dikembalikan" <?= $status == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                    <option value="ditolak" <?= $status == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="btn add" style="height: 38px;">Filter Data</button>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr style="background: #f4f6f9;">
                        <th>ID</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Qty</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['idpinjam'] ?></td>
                            <td><?= $row['peminjam'] ?></td>
                            <td><?= $row['namaalat'] ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td><?= $row['tglpinjam'] ?></td>
                            <td><?= $row['tglkembali'] ?: '-' ?></td>
                            <td>
                                <span style="font-weight:bold; color: #1f2a6d;">
                                    <?= strtoupper($row['status']) ?>
                                </span>
                            </td>
                            <td><?= $row['kondisiakhir'] ?: '-' ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align:center;">Tidak ada data ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>