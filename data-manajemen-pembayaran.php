<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5" >
        <h1>Data Pembayaran</h1>
        <p>Berikut adalah data yang sudah membayar</p>

        <a href="manajemen-pembayaran.php" class="btn btn-primary mb-3">Tambah Pembayaran Baru</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Booking</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('config.php');
        
                $data = mysqli_query($koneksi, "SELECT * FROM manajemen_pembayaran");
                $no = 0;
                while($baris = mysqli_fetch_array($data)){
                    $no++;

                
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $baris['booking']; ?>  </td>
                    <td><?php echo $baris['jumlah']; ?>  </td>
                    <td><?php echo $baris['metode']; ?>  </td>
                    <td><?php echo $baris['tanggal']; ?>  </td>
                    <td>
                        <a href="edit-manajemen-pembayaran.php?id=<?php echo $baris['id'] ?>">Edit</a>
                        <a href="src/api/hapus-manajemen-pembayaran.php?id=<?php echo $baris['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>