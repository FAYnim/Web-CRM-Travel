<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login.php");
    exit;
}

// Ambil data dari form
$nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Query insert
$query = "INSERT INTO kategori (nama_kategori, deskripsi, status) VALUES ('$nama_kategori', '$deskripsi', '$status')";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-kategori.php?status=success&message=Kategori berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-kategori.php?status=error&message=Gagal menambahkan kategori");
}
exit;
?>