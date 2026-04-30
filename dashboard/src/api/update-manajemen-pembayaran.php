<?php
include('../../config.php');

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $booking = $_POST['booking'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    $query_lama = mysqli_query($koneksi, "SELECT bukti_transfer FROM manajemen_pembayaran WHERE id='$id'");
    $data_lama = mysqli_fetch_assoc($query_lama);
    $bukti_transfer = $data_lama['bukti_transfer'] ?? '';

    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
        $target_dir = "../../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = strtolower(pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Format bukti transfer tidak didukung";
            exit;
        }

        $new_filename = 'bukti_pembayaran_' . uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file)) {
            if (!empty($bukti_transfer)) {
                $old_file_path = '../../' . $bukti_transfer;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }
            $bukti_transfer = "uploads/" . $new_filename;
        } else {
            echo "Gagal mengupload bukti transfer";
            exit;
        }
    }

    $update = mysqli_query($koneksi, "UPDATE manajemen_pembayaran 
        SET booking='$booking',
            tanggal='$tanggal',
            jumlah='$jumlah',
            metode='$metode',
            bukti_transfer='$bukti_transfer'
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
