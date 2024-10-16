<?php
if (isset($_POST['submit'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];


    $insert = mysqli_query($koneksi, "INSERT INTO anggota (nama_anggota,telepon,email,alamat)VALUES('$nama_anggota','$telepon','$email','$alamat')");

    if ($insert) {
        header("location:?pg=anggota&submit=berhasil");
    }
}


$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editanggota = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id ='$id'");
$rowanggota = mysqli_fetch_assoc($editanggota);

if (isset($_POST['edit'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    // if ($_POST['password']) {
    //     $password = sha1($_POST['password']);
    // } else {
    //     $password = $rowEdit['password'];
    // }
    // // $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    // $kategori=$_POST['']

    $update = mysqli_query($koneksi, "UPDATE anggota SET nama_anggota='$nama_anggota', telepon='$telepon', email ='$email', alamat='$_alamat', WHERE id='$id'");
    header("location:?pg=anggota&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id='$id'");
    header("location:?pg=anggota&hapus=berhasil");
}

$queryanggota = mysqli_query($koneksi, "SELECT*FROM anggota");
?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> Anggota</legend>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Nama Anggota</label>
                <input type="text" class="form-control" name="nama_anggota" placeholder="Masukkan nama anggota" value="<?php echo isset($_GET['edit']) ? $rowanggota['nama_anggota'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Telepon</label>
                <input type="text" class="form-control" name="telepon" placeholder="Masukkan telepon" value="<?php echo isset($_GET['edit']) ? $rowanggota['telepon'] : '' ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">email</label>
                <input type="text" class="form-control" name="email" placeholder="Masukkan email anda" value="<?php echo isset($_GET['edit']) ? $rowanggota['email'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" value="<?php echo isset($_GET['edit']) ? $rowanggota['alamat'] : '' ?>">
            </div>
            <div class="btn btn-primary">
                <button type="Submit" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </fieldset>
</div>