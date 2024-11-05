<?php
include 'koneksi.php';
// jika button daftar dim klik atau ditekan
if (isset($_POST['daftar'])){
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $nama_pengguna  = $_POST['nama_pengguna'];

    // masukkan data ke dalam tabel user kolom kolom tabel user () dan nilainya diambil dari inputan sesuai dengan urutan kolomnya
    mysqli_query($koneksi, "INSERT INTO user (email, password, nama_lengkap, nama_pengguna) VALUES ('$email', '$password' , '$nama_lengkap', '$nama_pengguna')");

    // melempar ke halaman login
    header("location:login.php?register=berhasil");


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css" />
    <title>Login Form - Library</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h5>Medsos X - Muhammad Gilang Ramadhan </h5>
                            </div>
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Email
                                    </label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter your email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                </div>
                                    <label for="" class="form-label">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap anda">            
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">
                                        Nama Pengguna
                                    </label>
                                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukkan nama pengguna">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-grid mb-3">
                                        <button class="btn btn-primary" name="daftar" type="submit">Daftar</button>
                                        <div class="form-group mb-3">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <p>Sudah punya akun?<a href="register.php" class="text-secondary">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>