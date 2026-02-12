<?php
include('config.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM manajemen_pembayaran WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('navbar.php'); ?>

    
    <div class="container col-md-6 mt-5">
        <h1>Pembayaran</h1>
        <p>Silakan edit data pembayaran dengan benar</p>

        <form method="POST" action="src/api/update-manajemen-pembayaran.php">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

          <div class="mb-3">
            <label class="form-label">Booking:</label>
            <input class="form-control" type="text" name="booking" value="<?php echo $data['booking']; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal:</label>
            <input class="form-control" type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>">
          </div>  

          <div class="mb-3">
            <label class="form-label">Jumlah:</label>
            <input class="form-control" type="text" name="jumlah" value="<?php echo $data['jumlah']; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Metode:</label>
            <input class="form-control" type="text" name="metode" value="<?php echo $data['metode']; ?>">
          </div>
            
            <button class="btn btn-primary"type="submit">Simpan</button>
              
        </form>
    </div>
</body>
</html>
