<?php 

$koneksi = mysqli_connect('localhost','root','','db_datasiswa');

function jurusan($jurusan)
{
echo "<select name='$jurusan'>";
$jurusan = array ('RPL', 'MM', 'TKJ');
foreach ($jurusan as $key){
echo "<option value='$key'>$key</option>";
}
echo "</select>";
}

function query($query)
{
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query); //nilai objek
    $kotakbesar = [];
    while ($kotakkecil = mysqli_fetch_assoc($hasil)){ //array assoc
        $kotakbesar [] = $kotakkecil;
    }
    return $kotakbesar;
}

function tambah ($post) {
    global $koneksi;

    $nama = $post["nama"];
    $nisn = $post["nisn"];
    $jurusan = $post["xxx"];
    $email = $post["email"];
    // $gambar = $post["gambar"];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    
    $sql = "INSERT INTO tbl_siswa VALUES (
        '','$nama','$nisn','$jurusan','$email','$gambar'
    )";
    
    $hasil = mysqli_query ($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

function upload () {
    $namafile = $_FILES ["gambar"] ["name"];
    $ukuranfile = $_FILES ["gambar"] ["size"];
    $error = $_FILES ["gambar"] ["error"];
    $tmpname = $_FILES ["gambar"] ["tmp_name"];

    if  ( $error === 4 ) {
        echo "
        <script>
        alert ('pilih gambar dahulu');
        </script>";

        return false;
    }

    $ekstensiValid = ['jpg','jpeg','png'];
    $ekstensigambar = explode ('.', $namafile);
    $ekstensigambar = strtolower ( end($ekstensigambar));

    if ( !in_array($ekstensigambar, $ekstensiValid)) {
        echo "
        <script>
        alert ('file yang diupload bukan gambar');
        </script>";

        return false;
}
if ( $ukuranfile > 2000000 ) {
    echo "
    <script>
    alert ('maaf, ukuran gambar terlalu besar') ;
    </script>";
    return false;
}
$namafilebaru = uniqid();
$namafilebaru .= '.';
$namafilebaru .= $ekstensigambar;

move_uploaded_file ($tmpname, 'property/img/' . $namafilebaru);

return $namafilebaru;
}

function ubah ($post) {
    global $koneksi;

   
    $id = htmlspecialchars($post["id"]);
    $nama = htmlspecialchars($post["nama"]);
    $nisn = htmlspecialchars($post["nisn"]);
    $jurusan = htmlspecialchars($post["xxx"]);
    $email = htmlspecialchars($post["email"]);
    // $gambarlama = htmlspecialchars($post["gambarlama"]);

    if ($_FILES ["gambar"]["error"] === 4){
    // $gambar = $gambarlama;
    }else{
    $gambar = upload();

    $sql = "UPDATE tbl_siswa SET
    nama = '$nama',
    nisn = '$nisn',
    jurusan = '$jurusan',
    email = '$email',
    gambar = '$gambar'

    WHERE id = '$id'";

    $hasil = mysqli_query ($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
    }

    
}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE 
                nama LIKE '%$keyword%' OR
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR 
                jurusan LIKE '%$keyword%'
                ";
    return query($query);
}

function register($post){
    global $conn;

    $username = strtolower(stripslashes($post["username"]));
    $password = mysqli_real_escape_string($conn, $post["password"]);
    $password2 = mysqli_real_escape_string($conn, $post["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
    }

    //cek konfirmasi password 
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>