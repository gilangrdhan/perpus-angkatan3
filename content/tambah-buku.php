<?php
if (isset($_POST['submit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];

    $insert = mysqli_query($koneksi, "INSERT INTO buku (nama_buku,penerbit,tahun_terbit,pengarang,id_kategori)VALUES('$nama_buku','$penerbit','$tahun_terbit','$pengarang','$id_kategori')");

    if ($insert) {
        header("location:?pg=buku&submit=berhasil");
    }
}


$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editbuku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id ='$id'");
$rowbuku = mysqli_fetch_assoc($editbuku);

if (isset($_POST['edit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];

    // if ($_POST['password']) {
    //     $password = sha1($_POST['password']);
    // } else {
    //     $password = $rowEdit['password'];
    // }
    // // $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    // $kategori=$_POST['']

    $update = mysqli_query($koneksi, "UPDATE buku SET nama_buku='$nama_buku', penerbit='$penerbit', tahun_terbit ='$tahun_terbit', pengarang='$_pengarang',id_kategori='$id_kategori' WHERE id='$id'");
    header("location:?pg=buku&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location:?pg=buku&hapus=berhasil");
}

$queryKategori = mysqli_query($koneksi, "SELECT*FROM kategori");
?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> Buku</legend>
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Nama Buku</label>
                <input type="text" class="form-control" name="nama_buku" placeholder="Masukkan buku anda" value="<?php echo isset($_GET['edit']) ? $rowbuku['nama_buku'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nama Kategori</label>
                <select name="id_kategori" id="" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <!-- option yg datanya di ambil dari tbl kategori -->
                    <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)): ?>
                        <option value="<?php echo $rowKategori['id']; ?>" <?php echo isset($_GET['edit']) && $rowKategori['id'] == $rowbuku['id_kategori'] ? 'selected' : ''; ?>>
                            <?php echo $rowKategori['nama_kategori']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nama Penerbit</label>
                <input type="text" class="form-control" name="penerbit" placeholder="Masukkan penerbit" value="<?php echo isset($_GET['edit']) ? $rowbuku['penerbit'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" name="tahun_terbit" placeholder="Masukkan tahun terbit" value="<?php echo isset($_GET['edit']) ? $rowbuku['tahun_terbit'] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" placeholder="Masukkan pengarang" value="<?php echo isset($_GET['edit']) ? $rowbuku['pengarang'] : '' ?>">
            </div>
            <div class="btn btn-primary">
                <button type="Submit" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </fieldset>
</div>