<?php
include('../../config.php');

$nama = $_POST['nama'];
$email = $_POST['email'];
$handphone = $_POST['handphone'];
$alamat = $_POST['alamat'];

// echo $nama . "<br>";
// echo $email . "<br>";
// echo $handphone . "<br>";
// echo $alamat . "<br>";

$submit = mysqli_query($koneksi,"INSERT INTO manajemen_customer (nama,email,handphone,alamat) VALUES ('$nama','$email','$handphone','$alamat')");

if($submit == TRUE){
    header("location: ../../data-manajemen-customer");
    // echo "Berhasil Tersimpan ke Database";
}else{
    echo "Gagal Tersimpan";
}
?>
