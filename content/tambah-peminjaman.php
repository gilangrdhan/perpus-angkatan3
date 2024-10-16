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

$queryBuku = mysqli_query($koneksi, "SELECT*FROM buku");
?>




<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Submit' ?> Buku</legend>
        <form action="" method="post">
            <div class="mb-3 row">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="" class="form-label">No Peminjaman</label>
                        <input type="text" class="form-control" name="no_peminjaman" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tgl_peminjaman" value="">
                    </div>
                    <div class="mb-3">
                        <label for="id_buku" class="form-label">Nama Buku</label>
                        <select name="id_buku" id="id_buku" class="form-control">
                            <option value="">Pilih Buku</option>
                            <!-- // ambil data buku dari table buku -->
                            <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                <option value="<?php echo $rowBuku['id']; ?>">
                                    <?php echo $rowBuku['nama_buku']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="id_anggota" class="form-label">Nama Anggota</label>
                        <select name="id_anggota" id="id_anggota" class="form-control">
                            <option value="">Pilih Anggota</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Penggembalian</label>
                        <input type="date" class="form-control" name="tgl_pengembalian" value="">
                    </div>
                </div>
            </div>
            <div align="right" class="mb-3">
                <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
            </div>
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-row">

                </tbody>
            </table>
        </form>
    </fieldset>
</div>