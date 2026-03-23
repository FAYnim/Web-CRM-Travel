<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil data dari form
$nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
$pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);
$rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);

// Query insert
$query = "INSERT INTO testimoni (nama_pelanggan, pesan, rating, status, tanggal) VALUES ('$nama_pelanggan', '$pesan', '$rating', '$status', '$tanggal')";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-testimoni?status=success&message=Testimoni berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-testimoni?status=error&message=Gagal menambahkan testimoni");
}
exit;
?>
