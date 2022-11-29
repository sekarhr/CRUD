<?php
require 'functions.php';

// tangkap data id di URL
$id = $_GET ["id"];

$siswa = query ("SELECT * FROM tbl_siswa WHERE id = $id") [0];
if ( isset ($_POST ["kirim"])) {
    //cek apakah data berhasil diubah
    if (ubah ($_POST) > 0) {
        echo "
        <script>
            alert ('data berhasil diubah');
            document.location.href = 'index.php';
        </script>";

    }else {
        echo "
        <script>
        alert ('data gagal diubah');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form ubah</title>
</head>
<body>
    <h1>form ubah</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $siswa ["id"]; ?>">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" value="<?=$siswa ["nama"]; ?>">
    <br><br>
    <label for="nisn">Nisn:</label> 
    <input type="number" name="nisn" id="nisn" value="<?=$siswa ["nisn"]; ?>">
    <br><br>
    <label for="jurusan">Jurusan:</label>
    <?= jurusan("xxx") ?>
    <input type="text" name="jurusan" id="jurusan" value="<?=$siswa ["jurusan"]; ?>">
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?=$siswa ["email"]; ?>">
    <br><br>
    <label for="gambar">Gambar:</label>
    <input type="file"  name="gambar" id="gambar">
    <br><br>
    <button type="submit" name="kirim">Kirim</button>
   </form> 

</body>
</html>










