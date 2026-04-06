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

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query delete
$query = "DELETE FROM klien_korporasi WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-klien-korporasi.php?status=success&message=Klien korporasi berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-klien-korporasi.php?status=error&message=Gagal menghapus klien korporasi");
=======
    header("Location: ../../data-manajemen-klien-korporasi?status=success&message=Klien korporasi berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-klien-korporasi?status=error&message=Gagal menghapus klien korporasi");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
}
exit;
?>
