<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container col-md-6 mt-5">
        <h1>Manajemen Pembayaran</h1>
        <p>Silakan isi data dibawah ini dengan benar</p>

        <form method="POST" action="src/api/submit-manajemen-pembayaran.php">
          <div class="mb-3">
            <label class="form-label">Nomer:</label>
            <input class="form-control" type="text" name="nomer" placeholder="Isi Dengan Nomer..." required> 
          </div>

          <div class="mb-3">
            <label class="form-label">Booking:</label>
            <input class="form-control" type="text" name="booking" placeholder="Isi Dengan Booking..." required>
          </div>  

          <div class="mb-3">
            <label class="form-label">Tanggal:</label>
            <input class="form-control" type="date" name="tanggal" placeholder="Isi Dengan Tanggal..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Jumlah:</label>
            <input class="form-control" type="text" name="jumlah" placeholder="Isi Dengan Jumlah..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Metode:</label>
            <input class="form-control" type="text" name="metode" placeholder="Isi Dengan Metode..." required>
          </div>
            
            <button class="btn btn-primary"type="submit">Submit</button>
              
        </form>
    </div>
    
</body>
</html>