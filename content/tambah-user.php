<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];

    $insert = mysqli_query($koneksi, "INSERT INTO user (nama,email,password,jenis_kelamin,telepon)VALUES('$nama','$email','$password','$jenis_kelamin','$telepon')");
    header("location:?pg=user&submit=berhasil");
}


$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];

    if ($_POST['password']) {
        $password = sha1($_POST['password']);
    } else {
        $password = $rowEdit['password'];
    }
    // $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];

    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email = '$email', password='$password', jenis_kelamin =$jenis_kelamin, telepon =$telepon WHERE id='$id'");
    header("location:?pg=user&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header("location:?pg=user&hapus=berhasil");
}

?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> User</legend>



        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">email</label>
                <input type="text" class="form-control" name="email" placeholder="Masukkan email anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">password</label>
                <input type="text" class="form-control" name="password" placeholder="Masukkan password anda">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">jenis kelamin</label>
                <input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == 'laki-laki' ? 'checked' : '') :  '' ?>> laki-laki
                <input type="radio" name="jenis_kelamin" value="perempuan"><?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == 'perempuan' ? 'checked' : '') :  '' ?>perempuan
            </div>
            <div class="mb-3">
                <label for="" class="form-label">telepon</label>
                <input type="text" class="form-control" name="telepon" placeholder="Masukkan telepon anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['telepon'] : '' ?>">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
    </fieldset>
</div>