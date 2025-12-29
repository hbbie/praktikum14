<?php
// 1. Inisialisasi variabel pencarian sesuai modul [cite: 40, 46]
$q = ""; 
$sql_where = "";

// 2. Logika filter pencarian Praktikum 14 [cite: 41, 47, 54]
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE nama LIKE '{$q}%'"; 
}

include_once 'koneksi.php'; // [cite: 50]

// 3. Menghitung total data untuk Pagination (Gabungan Praktikum 13 & 14)
$sql_count = "SELECT COUNT(*) FROM data_barang" . $sql_where;
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_row($result_count);
$total_data = $row_count[0];

// 4. Pengaturan Pagination
$per_page = 2; 
$num_page = ceil($total_data / $per_page);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// 5. Query Utama dengan Filter Pencarian dan Limit [cite: 51, 54, 55]
$sql = "SELECT * FROM data_barang" . $sql_where . " LIMIT {$offset}, {$per_page}";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang - Praktikum 14</title>
    <style>
        /* CSS Modern & Menarik */
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; margin: 0; }
        .container { width: 90%; max-width: 1100px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { color: #333; border-left: 5px solid #337ab7; padding-left: 15px; }
        
        .main-nav { background: #337ab7; display: flex; border-radius: 5px; margin-bottom: 20px; }
        .main-nav a { color: white; text-decoration: none; padding: 12px 20px; font-weight: bold; }
        .main-nav a.active { background: #286090; }

        .btn { padding: 8px 15px; border-radius: 4px; text-decoration: none; display: inline-block; cursor: pointer; border: none; font-size: 14px; }
        .btn-tambah { background: #2ecc71; color: white; margin-bottom: 20px; }
        .btn-primary { background: #337ab7; color: white; }
        .btn-danger { background: #d9534f; color: white; }

        /* Form Pencarian [cite: 25, 29, 31] */
        .search-form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #eee; }
        .input-q { padding: 8px; width: 250px; border: 1px solid #ddd; border-radius: 4px; }

        /* Tabel & Gambar */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f1f1f1; padding: 12px; text-align: left; border-bottom: 2px solid #ddd; }
        td { padding: 12px; border-bottom: 1px solid #eee; vertical-align: middle; }
        .img-barang { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd; }

        /* Pagination */
        .pagination { display: flex; list-style: none; padding: 0; margin-top: 20px; gap: 5px; }
        .pagination li a { padding: 8px 15px; border: 1px solid #ddd; text-decoration: none; color: #337ab7; border-radius: 4px; }
        .pagination li.active a { background: #337ab7; color: white; border-color: #337ab7; }
        
        footer { margin-top: 30px; padding: 15px; background: #222; color: #fff; text-align: center; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Membuat Database Sederhana</h1>
        
        <nav class="main-nav">
            <a href="index.php" class="active">Home</a>
            <a href="#">Login</a>
        </nav>

        <a href="tambah.php" class="btn btn-tambah">Tambah Barang</a>

        <form action="" method="get" class="search-form">
            <label for="q">Cari data: </label>
            <input type="text" id="q" name="q" class="input-q" value="<?= htmlspecialchars($q) ?>">
            <input type="submit" name="submit" value="Cari" class="btn btn-primary">
        </form>

        <table>
            <thead>
                <tr>
                    <th>Gambar</th><th>Nama Barang</th><th>Katagori</th>
                    <th>Harga Jual</th><th>Harga Beli</th><th>Stok</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td>
                            <?php if(!empty($row['gambar'])): ?>
                                <img src="gambar/<?= $row['gambar'] ?>" class="img-barang">
                            <?php else: ?>
                                <small>No Image</small>
                            <?php endif; ?>
                        </td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['kategori'] ?></td>
                        <td><?= number_format($row['harga_jual'], 0, ',', '.') ?></td>
                        <td><?= number_format($row['harga_beli'], 0, ',', '.') ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td>
                            <a href="#" class="btn" style="background:#eee; color:#333; border:1px solid #ccc;">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <ul class="pagination">
            <?php for($i=1; $i<=$num_page; $i++): ?>
                <li class="<?= ($page == $i) ? 'active' : '' ?>">
                    <a href="?page=<?= $i ?>&q=<?= $q ?>&submit=Cari"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>

        <footer>
            <p>&copy; 2014 - STT Pelita Bangsa Bekasi</p>
        </footer>
    </div>
</body>
</html>