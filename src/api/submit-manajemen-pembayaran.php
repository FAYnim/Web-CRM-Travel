<?php
include('../../config.php');

$booking = $_POST['booking'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$metode = $_POST['metode'];

$submit = mysqli_query($koneksi,"INSERT INTO manajemen_pembayaran (booking,tanggal,jumlah,metode) VALUES ('$booking','$tanggal','$jumlah','$metode')");

if($submit == TRUE){
    // echo "Berhasil Tersimpan ke Database";
	header("Location: ../../data-manajemen-pembayaran");
}else{
    echo "Gagal Tersimpan";
}
?>
