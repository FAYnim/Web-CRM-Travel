<?php
include('../../config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT bukti_transfer FROM manajemen_pembayaran WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!empty($data['bukti_transfer'])) {
        $file_path = '../../' . $data['bukti_transfer'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    mysqli_query($koneksi, "DELETE FROM manajemen_pembayaran WHERE id='$id'");
}

header("Location: ../../data-manajemen-pembayaran");
exit;
?>
