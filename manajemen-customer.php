<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container col-md-6 mt-5">
        <h1>Customer</h1>
        <p>Silakan isi data dibawah ini dengan benar</p>

        <form method="POST" action="submit.php">
          <div class="mb-3">
            <label class="form-label">Nama:</label>
            <input class="form-control" type="text" name="nama" placeholder="Isi Dengan Nama..." required> 
          </div>

          <div class="mb-3">
            <label class="form-label">Email:</label>
            <input class="form-control" type="email" name="email" placeholder="Isi Dengan Email..." required>
          </div>  

          <div class="mb-3">
            <label class="form-label">Handphone:</label>
            <input class="form-control" type="number" name="handphone" placeholder="Isi Dengan No.HP..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Alamat:</label>
            <input class="form-control" type="text" name="alamat" placeholder="Isi Dengan Alamat..." required>
          </div>
            
            <button class="btn btn-primary"type="submit">Submit</button>
              
        </form>
    </div>
    
</body>
</html>