<?php
if (isset($_POST['submit'])) {
    $kategori = $_POST['nama_kategori'];

    $insert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori)VALUES('$kategori')");

    if ($insert) {
        header("location:?pg=kategori&submit=berhasil");
    }
}


$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editKategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id ='$id'");
$rowEdit = mysqli_fetch_assoc($editKategori);

if (isset($_POST['edit'])) {
    $nama_kategori = $_POST['nama_kategori'];


    // if ($_POST['password']) {
    //     $password = sha1($_POST['password']);
    // } else {
    //     $password = $rowEdit['password'];
    // }
    // // $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    // $kategori=$_POST['']

    $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id='$id'");
    header("location:?pg=kategori&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id='$id'");
    header("location:?pg=kategori&hapus=berhasil");
}

?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> Kategori</legend>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">nama kategori</label>
                <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan kategori anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_kategori'] : '' ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</fieldset>
</div>