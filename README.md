# praktikum14
Tugas Pertemuan 15

1. Tujuan Program

Program ini bertujuan untuk menambahkan fungsionalitas pencarian pada daftar barang. Hal ini memungkinkan pengguna menemukan data spesifik tanpa harus memeriksa seluruh daftar secara manual, terutama jika jumlah data sudah sangat banyak.

2. Logika Query SQL (Filter Data)

Inti dari fitur pencarian terletak pada modifikasi query SQL:

    Query Awal: Secara standar, query untuk menampilkan semua data adalah SELECT * FROM data_barang.

Query dengan Filter: Untuk mencari data tertentu, ditambahkan klausa WHERE sebagai penyaring.

Penggunaan LIKE: Program menggunakan operator LIKE dengan simbol %. Contoh: WHERE nama LIKE '{$q}%' akan mencari data yang berawalan dengan karakter yang diketik pengguna.

3. Komponen Utama Kode

Berdasarkan modul Praktikum 14, program dibagi menjadi beberapa bagian penting:

    Inisialisasi Variabel: Variabel $q disiapkan untuk menampung kata kunci pencarian dari pengguna agar nilai tersebut tetap muncul di kolom input setelah tombol ditekan.

Metode Pengiriman Data (GET): Form pencarian menggunakan method="get". Ini artinya kata kunci pencarian akan terlihat di URL browser (misal: index.php?q=panahan), yang memudahkan integrasi dengan fitur lain seperti pagination.

Kondisi Pemeriksaan: Program memeriksa apakah tombol cari (submit) telah diklik dan input tidak kosong sebelum mengubah query dasar menjadi query pencarian.

4. Alur Kerja Antarmuka (UI)

    Form Input: Pengguna memasukkan nama barang pada elemen <input type="text" name="q">.

Tombol Cari: Saat tombol <input type="submit"> ditekan, data dikirim ke server.

Penempatan Form: Form pencarian diletakkan di file index.php (daftar barang), tepat sebelum tabel data dan setelah tombol tambah data agar mudah diakses.

Tampilan Hasil: Jika data ditemukan, tabel akan menampilkan hasil filter; jika tidak ada kata kunci, tabel kembali menampilkan seluruh data barang.

5. Contoh Implementasi SQL

Jika Anda mencari kata "panahan", maka variabel $q berisi "panahan". Query yang dijalankan ke database secara otomatis berubah menjadi: SELECT * FROM data_barang WHERE nama LIKE 'panahan%'.
