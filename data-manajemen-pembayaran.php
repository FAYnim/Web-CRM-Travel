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

    <table class="table">
        <thead>
            <tr>
                <th>Booking</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Metode</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include('koneksi.php');
    
            $data = mysqli_query($koneksi, "SELECT * FROM data");
            $no = 0;
            while($baris = mysqli_fetch_array($data)){
                $no++;

            
            ?>
            <tr>
                <td><?php echo $baris['booking']; ?>  </td>
                <td><?php echo $baris['tanggal']; ?>  </td>
                <td><?php echo $baris['jumlah']; ?>  </td>
                <td><?php echo $baris['metode']; ?>  </td>
                <td>
                    <a href="edit.php?no=<?php echo $baris ['no']; ?>">EDIT  </a>
                    <a href="hapus.php?no=<?php echo $baris ['no']; ?>">HAPUS </a>
                    </td>
                    
                    
            </tr>
            <?php } ?>
        </tbody>
    </table>

    </div>
    
</body>
</html>