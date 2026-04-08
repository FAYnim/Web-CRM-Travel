<?php
include('../../config.php');

$nama = $_POST['nama'];
$paket = $_POST['paket'];

// Check if customer exists, if not create new customer
$cek_customer = mysqli_query($koneksi, "SELECT id FROM manajemen_customer WHERE nama = '$nama'");
if(mysqli_num_rows($cek_customer) > 0){
    $customer = mysqli_fetch_array($cek_customer);
    $customer_id = $customer['id'];
}else{
    // Insert new customer with default values for email, handset, alamat
    $insert_customer = mysqli_query($koneksi, "INSERT INTO manajemen_customer (nama, email, handset, alamat) VALUES ('$nama', '-', 0, '-')");
    $customer_id = mysqli_insert_id($koneksi);
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
