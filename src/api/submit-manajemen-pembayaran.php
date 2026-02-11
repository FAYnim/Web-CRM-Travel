<?php
include('config.php');

$booking = $_POST['booking'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$metode = $_POST['metode'];

// echo $nama . "<br>";
// echo $email . "<br>";
// echo $handphone . "<br>";
// echo $alamat . "<br>";

$submit = mysqli_query($koneksi,"INSERT INTO manajemen_pembayaran (booking,tanggal,jumlah,metode) VALUES ('$booking','$tanggal','$jumlah','$metode')");

if($submit == TRUE){
    echo "Berhasil Tersimpan ke Database";
}else{
    echo "Gagal Tersimpan";
}
?>