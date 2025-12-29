<?php
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    // LOGIKA UPLOAD GAMBAR
    $nama_file = $_FILES['gambar']['name'];
    $sumber_file = $_FILES['gambar']['tmp_name'];
    $folder_tujuan = "gambar/";

    // Pindahkan file ke folder 'gambar'
    move_uploaded_file($sumber_file, $folder_tujuan . $nama_file);

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) 
            VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$nama_file}')";
    
    if (mysqli_query($conn, $sql)) {
        header('location: index.php');
    }
}
?>

<form method="post" action="" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" required><br>
    Kategori: <input type="text" name="kategori"><br>
    Harga Jual: <input type="number" name="harga_jual"><br>
    Harga Beli: <input type="number" name="harga_beli"><br>
    Stok: <input type="number" name="stok"><br>
    Pilih Gambar: <input type="file" name="gambar"><br>
    <input type="submit" name="submit" value="Simpan">
</form>