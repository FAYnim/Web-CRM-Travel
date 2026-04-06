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
$nama_maskapai = mysqli_real_escape_string($koneksi, $_POST['nama_maskapai']);
$kode_maskapai = mysqli_real_escape_string($koneksi, $_POST['kode_maskapai']);
$negara_asal = mysqli_real_escape_string($koneksi, $_POST['negara_asal']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

<<<<<<< HEAD
if (mb_strlen($deskripsi) > 250) {
    header("Location: ../../manajemen-partner.php?status=error&message=Deskripsi maksimal 250 karakter");
    exit;
}

=======
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
// Query insert
$query = "INSERT INTO partner_maskapai (nama_maskapai, kode_maskapai, negara_asal, deskripsi, status) VALUES ('$nama_maskapai', '$kode_maskapai', '$negara_asal', '$deskripsi', '$status')";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-partner.php?status=success&message=Partner maskapai berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-partner.php?status=error&message=Gagal menambahkan partner maskapai");
=======
    header("Location: ../../data-manajemen-partner?status=success&message=Partner maskapai berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-partner?status=error&message=Gagal menambahkan partner maskapai");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
}
exit;
?>
