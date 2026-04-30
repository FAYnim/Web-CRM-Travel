<?php
include('../../config.php');

$booking = $_POST['booking'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$metode = $_POST['metode'];
$bukti_transfer = "";

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
        $bukti_transfer = "uploads/" . $new_filename;
    } else {
        echo "Gagal mengupload bukti transfer";
        exit;
    }
}

$submit = mysqli_query($koneksi,"INSERT INTO manajemen_pembayaran (booking,tanggal,jumlah,metode,bukti_transfer) VALUES ('$booking','$tanggal','$jumlah','$metode','$bukti_transfer')");

if($submit == TRUE){
    // echo "Berhasil Tersimpan ke Database";
	header("Location: ../../data-manajemen-pembayaran");
}else{
    echo "Gagal Tersimpan";
}
?>
