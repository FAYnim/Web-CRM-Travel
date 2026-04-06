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

<<<<<<< HEAD
if (mb_strlen($keterangan) > 250) {
    header("Location: ../../manajemen-klien-korporasi.php?status=error&message=Deskripsi maksimal 250 karakter");
    exit;
}

=======
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
// Query insert
$query = "INSERT INTO klien_korporasi (nama_perusahaan, alamat, telepon, email, nama_pic, jabatan_pic, telepon_pic, email_pic, status, tanggal_bergabung, keterangan)
          VALUES ('$nama_perusahaan', '$alamat', '$telepon', '$email', '$nama_pic', '$jabatan_pic', '$telepon_pic', '$email_pic', '$status', '$tanggal_bergabung', '$keterangan')";

$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-klien-korporasi.php?status=success&message=Klien korporasi berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-klien-korporasi.php?status=error&message=Gagal menambahkan klien korporasi");
=======
    header("Location: ../../data-manajemen-klien-korporasi?status=success&message=Klien korporasi berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-klien-korporasi?status=error&message=Gagal menambahkan klien korporasi");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
}
exit;
?>
