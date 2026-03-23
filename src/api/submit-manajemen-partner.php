<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil data dari form
$nama_maskapai = mysqli_real_escape_string($koneksi, $_POST['nama_maskapai']);
$kode_maskapai = mysqli_real_escape_string($koneksi, $_POST['kode_maskapai']);
$negara_asal = mysqli_real_escape_string($koneksi, $_POST['negara_asal']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Query insert
$query = "INSERT INTO partner_maskapai (nama_maskapai, kode_maskapai, negara_asal, deskripsi, status) VALUES ('$nama_maskapai', '$kode_maskapai', '$negara_asal', '$deskripsi', '$status')";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-partner?status=success&message=Partner maskapai berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-partner?status=error&message=Gagal menambahkan partner maskapai");
}
exit;
?>
