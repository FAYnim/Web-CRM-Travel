<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
<<<<<<< HEAD
    header("Location: ../../login.php");
=======
    header("Location: ../../login");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
    exit;
}

// Ambil data dari form
$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Query update
$query = "UPDATE kategori SET nama_kategori = '$nama_kategori', deskripsi = '$deskripsi', status = '$status' WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-kategori.php?status=success&message=Kategori berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-kategori.php?id=$id&status=error&message=Gagal mengupdate kategori");
}
exit;
?>
=======
    header("Location: ../../data-manajemen-kategori?status=success&message=Kategori berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-kategori?id=$id&status=error&message=Gagal mengupdate kategori");
}
exit;
?>
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
