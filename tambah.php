<?php 
require 'functions.php';



if ( isset ($_POST ["kirim"]) ) {

    if ( tambah ($_POST) > 0 ) {
        echo "
        <script>
            alert ('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert ('data gagal ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Siswa</title>
</head>
<body>
   <h1>Tambah Data!</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama">
    <br><br>
    <label for="nisn">Nisn:</label>
    <input type="number" name="nisn" id="nisn">
    <br><br>
    <label for="jurusan">Jurusan:</label>
    <?= jurusan("xxx") ?>
    <!-- <input type="text" name="jurusan" id="jurusan"> -->
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <br><br>
    <label for="gambar">Gambar:</label>
    <input type="file"  name="gambar" id="gambar">
    <br><br>
    <button type="submit" name="kirim">Kirim</button>
   </form> 
</body>
</html>