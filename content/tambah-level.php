<?php
if (isset($_POST['submit'])) {
    $level = $_POST['nama_level'];

    $insert = mysqli_query($koneksi, "INSERT INTO level (nama_level)VALUES('$level')");

    if ($insert) {
        header("location:?pg=level&submit=berhasil");
    }
}


$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editlevel = mysqli_query($koneksi, "SELECT * FROM level WHERE id ='$id'");
$rowlevel = mysqli_fetch_assoc($editlevel);

if (isset($_POST['edit'])) {
    $nama_level = $_POST['nama_level'];


    // if ($_POST['password']) {
    //     $password = sha1($_POST['password']);
    // } else {
    //     $password = $rowEdit['password'];
    // }
    // // $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    // $kategori=$_POST['']

    $update = mysqli_query($koneksi, "UPDATE level SET nama_level='$nama_level' WHERE id='$id'");
    header("location:?pg=level&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id='$id'");
    header("location:?pg=level&hapus=berhasil");
}

?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> level</legend>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">nama level</label>
                <input type="text" class="form-control" name="nama_level" placeholder="Masukkan level anda" value="<?php echo isset($_GET['edit']) ? $rowlevel['nama_level'] : '' ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</fieldset>
</div>