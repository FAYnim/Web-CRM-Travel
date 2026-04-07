<?php
include('../../config.php');

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $booking = $_POST['booking'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    $update = mysqli_query($koneksi, "UPDATE manajemen_pembayaran 
        SET booking='$booking',
            tanggal='$tanggal',
            jumlah='$jumlah',
            metode='$metode'
        WHERE id='$id'");

    if($update){
        header("Location: ../../data-manajemen-pembayaran");
        // echo "Berhasil Terupdate ke Database";
    }else{
        echo "Gagal Terupdate: " . mysqli_error($koneksi);
    }

}else{
    echo "ID tidak ditemukan";
}
?>
