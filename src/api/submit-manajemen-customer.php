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
<<<<<<< HEAD
    header("location: ../../data-manajemen-customer.php");
=======
    header("location: ../../data-manajemen-customer");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
    // echo "Berhasil Tersimpan ke Database";
}else{
    echo "Gagal Tersimpan";
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
