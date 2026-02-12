<?php
include('config.php');

$page_title = 'Data Booking';
ob_start();
?>

<div class="dashboard-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-calendar-check me-2"></i>Data Booking</span>
        <a href="manajemen-booking.php" class="btn btn-primary btn-sm">
            <i class="bi bi-calendar-plus me-1"></i>Tambah Booking Baru
        </a>
    </div>
    <div class="card-body p-0">
        <p class="text-muted px-3 pt-3 mb-3">Berikut adalah data yang sudah terdaftar.</p>
        <div class="table-responsive">
            <table class="table table-dashboard">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Paket</th>
                        <th>Tanggal Booking</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT b.id, c.nama as customer, p.nama_paket as paket, b.tanggal 
                                                    FROM manajemen_booking b 
                                                    LEFT JOIN manajemen_customer c ON b.customer_id = c.id 
                                                    LEFT JOIN manajemen_paket p ON b.paket_id = p.id 
                                                    ORDER BY b.id DESC");
                    while($baris = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td>
                            <i class="bi bi-person-circle me-1 text-muted"></i>
                            <?php echo htmlspecialchars($baris['customer'] ?? '-'); ?>
                        </td>
                        <td><?php echo htmlspecialchars($baris['paket'] ?? '-'); ?></td>
                        <td><?php echo $baris['tanggal'] ? date('d M Y H:i', strtotime($baris['tanggal'])) : '-'; ?></td>
                        <td>
                            <a href="src/api/hapus-manajemen-booking.php?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include('layout.php');
?>
