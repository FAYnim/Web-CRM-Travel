<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil data dari form
$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama_maskapai = mysqli_real_escape_string($koneksi, $_POST['nama_maskapai']);
$kode_maskapai = mysqli_real_escape_string($koneksi, $_POST['kode_maskapai']);
$negara_asal = mysqli_real_escape_string($koneksi, $_POST['negara_asal']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Query update
$query = "UPDATE partner_maskapai SET nama_maskapai = '$nama_maskapai', kode_maskapai = '$kode_maskapai', negara_asal = '$negara_asal', deskripsi = '$deskripsi', status = '$status' WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-partner?status=success&message=Partner maskapai berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-partner?id=$id&status=error&message=Gagal mengupdate partner maskapai");
}
exit;
?>
