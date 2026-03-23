<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil data dari form
$nama_perusahaan = mysqli_real_escape_string($koneksi, $_POST['nama_perusahaan']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
$whatsapp = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$tentang_kami = mysqli_real_escape_string($koneksi, $_POST['tentang_kami']);
$facebook = mysqli_real_escape_string($koneksi, $_POST['facebook']);
$instagram = mysqli_real_escape_string($koneksi, $_POST['instagram']);
$twitter = mysqli_real_escape_string($koneksi, $_POST['twitter']);
$youtube = mysqli_real_escape_string($koneksi, $_POST['youtube']);
$linkedin = mysqli_real_escape_string($koneksi, $_POST['linkedin']);

// Cek apakah data profil sudah ada
$check_query = "SELECT id FROM profil WHERE id = 1";
$check_result = mysqli_query($koneksi, $check_query);

if(mysqli_num_rows($check_result) > 0) {
    // Update data yang sudah ada
    $query = "UPDATE profil SET 
              nama_perusahaan = '$nama_perusahaan',
              email = '$email',
              telepon = '$telepon',
              whatsapp = '$whatsapp',
              alamat = '$alamat',
              tentang_kami = '$tentang_kami',
              facebook = '$facebook',
              instagram = '$instagram',
              twitter = '$twitter',
              youtube = '$youtube',
              linkedin = '$linkedin'
              WHERE id = 1";
} else {
    // Insert data baru
    $query = "INSERT INTO profil (id, nama_perusahaan, email, telepon, whatsapp, alamat, tentang_kami, facebook, instagram, twitter, youtube, linkedin) 
              VALUES (1, '$nama_perusahaan', '$email', '$telepon', '$whatsapp', '$alamat', '$tentang_kami', '$facebook', '$instagram', '$twitter', '$youtube', '$linkedin')";
}

$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman setting profil dengan pesan sukses
    header("Location: ../../setting-profil?status=success");
} else {
    // Redirect dengan pesan error
    header("Location: ../../setting-profil?status=error&message=Gagal menyimpan data profil");
}
exit;
?>
