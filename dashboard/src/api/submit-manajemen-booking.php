<?php
include('../../config.php');

$customer_id = isset($_POST['customer_id']) ? (int) $_POST['customer_id'] : 0;
$paket = $_POST['paket'];

if($customer_id <= 0){
    echo "Customer tidak valid";
    exit;
}

$cek_customer = mysqli_query($koneksi, "SELECT id FROM manajemen_customer WHERE id = '$customer_id'");
if(mysqli_num_rows($cek_customer) === 0){
    echo "Customer tidak ditemukan";
    exit;
}

// Check if paket exists, if not create new paket
$cek_paket = mysqli_query($koneksi, "SELECT id FROM manajemen_paket WHERE nama_paket = '$paket'");
if(mysqli_num_rows($cek_paket) > 0){
    $pkt = mysqli_fetch_array($cek_paket);
    $paket_id = $pkt['id'];
}else{
    // Insert new paket with default values
    $insert_paket = mysqli_query($koneksi, "INSERT INTO manajemen_paket (nama_paket, durasi, lokasi, harga, gambar, label, rating) VALUES ('$paket', '-', '-', 0, '-', '-', 0)");
    $paket_id = mysqli_insert_id($koneksi);
}

// Insert into manajemen_booking
$submit = mysqli_query($koneksi, "INSERT INTO manajemen_booking (customer_id, paket_id) VALUES ('$customer_id', '$paket_id')");

if($submit == TRUE){
    header("Location: ../../data-manajemen-booking");
}else{
    echo "Gagal Tersimpan";
}
?>
