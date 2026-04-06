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
$nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

<<<<<<< HEAD
if (mb_strlen($deskripsi) > 250) {
    header("Location: ../../manajemen-kategori.php?status=error&message=Deskripsi maksimal 250 karakter");
    exit;
}

=======
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
// Query insert
$query = "INSERT INTO kategori (nama_kategori, deskripsi, status) VALUES ('$nama_kategori', '$deskripsi', '$status')";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-kategori.php?status=success&message=Kategori berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-kategori.php?status=error&message=Gagal menambahkan kategori");
}
exit;
?>
=======
    header("Location: ../../data-manajemen-kategori?status=success&message=Kategori berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-kategori?status=error&message=Gagal menambahkan kategori");
}
exit;
?>
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
