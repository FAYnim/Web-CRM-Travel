<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
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

// Query insert
$query = "INSERT INTO klien_korporasi (nama_perusahaan, alamat, telepon, email, nama_pic, jabatan_pic, telepon_pic, email_pic, status, tanggal_bergabung, keterangan)
          VALUES ('$nama_perusahaan', '$alamat', '$telepon', '$email', '$nama_pic', '$jabatan_pic', '$telepon_pic', '$email_pic', '$status', '$tanggal_bergabung', '$keterangan')";

$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-klien-korporasi?status=success&message=Klien korporasi berhasil ditambahkan");
} else {
    // Redirect dengan pesan error
    header("Location: ../../manajemen-klien-korporasi?status=error&message=Gagal menambahkan klien korporasi");
}
exit;
?>
