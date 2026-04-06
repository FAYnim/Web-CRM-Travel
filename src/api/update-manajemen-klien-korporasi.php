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
$nama_perusahaan = mysqli_real_escape_string($koneksi, $_POST['nama_perusahaan']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$nama_pic = mysqli_real_escape_string($koneksi, $_POST['nama_pic']);
$jabatan_pic = mysqli_real_escape_string($koneksi, $_POST['jabatan_pic']);
$telepon_pic = mysqli_real_escape_string($koneksi, $_POST['telepon_pic']);
$email_pic = mysqli_real_escape_string($koneksi, $_POST['email_pic']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$tanggal_bergabung = mysqli_real_escape_string($koneksi, $_POST['tanggal_bergabung']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// Query update
$query = "UPDATE klien_korporasi SET
          nama_perusahaan = '$nama_perusahaan',
          alamat = '$alamat',
          telepon = '$telepon', 
          email = '$email', 
          nama_pic = '$nama_pic', 
          jabatan_pic = '$jabatan_pic', 
          telepon_pic = '$telepon_pic', 
          email_pic = '$email_pic', 
          status = '$status', 
          tanggal_bergabung = '$tanggal_bergabung', 
          keterangan = '$keterangan' 
          WHERE id = '$id'";

$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-klien-korporasi.php?status=success&message=Klien korporasi berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-klien-korporasi.php?id=$id&status=error&message=Gagal mengupdate klien korporasi");
=======
    header("Location: ../../data-manajemen-klien-korporasi?status=success&message=Klien korporasi berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-klien-korporasi?id=$id&status=error&message=Gagal mengupdate klien korporasi");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
}
exit;
?>
