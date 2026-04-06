<?php
include('../../config.php');

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $handphone = $_POST['handphone'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE manajemen_customer 
        SET nama='$nama',
            email='$email',
            handphone='$handphone',
            alamat='$alamat'
        WHERE id='$id'");

    if($update){
<<<<<<< HEAD
        header("Location: ../../data-manajemen-customer.php");
=======
        header("Location: ../../data-manajemen-customer");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
        // echo "Berhasil Terupdate ke Database";
    }else{
        echo "Gagal Terupdate: " . mysqli_error($koneksi);
    }

}else{
    echo "ID tidak ditemukan";
}
?>
