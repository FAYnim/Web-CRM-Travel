<?php

$server = "localhost";
$user = "root";
$password = "";
$nama_db = "web_crm_travel";

$koneksi = mysqli_connect($server, $user, $password, $nama_db);

if($koneksi == TRUE) {
    // echo "Berhasil terhubung";
} else {
    echo "Gagal terhubung";
}

?>