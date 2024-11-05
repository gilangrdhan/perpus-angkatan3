<?php
//menampilkan data user berdasarkan id user
$id_user    = $_SESSION['ID'];
$queryUser  = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id_user'");
$rowUser    = mysqli_fetch_assoc($queryUser);

$queryTweet  = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id_user ='$id_user'");
$rowTweet    = mysqli_fetch_assoc($queryTweet);



if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email        = $_POST['email'];

    //jika gambar mau diubah
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        //png,jpg,jpeg
        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //jika extensi foto tidak ada ext yang terdaftar di array ext
        if (!in_array($extFoto, $ext)) {
            echo "Ekstensi tidak ditemukan";
            die;
        } else {
            // Pindahkan gambar dari tmp ke folder yang sudah kita buat
            // unlink() : mendelete file
            unlink('upload/' . $rowUser['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
            $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna = '$nama_pengguna', email ='$email', foto='$nama_foto' WHERE id ='$id_user'");
        }
    } else {
        //gambar tidak mau diubah
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna = '$nama_pengguna', email ='$email', foto='$nama_foto' WHERE id ='$id_user'");
    }
    header("location:?pg=profil&ubah=berhasil");
}

if (isset($_POST['edit_cover'])) {


    //jika gambar mau diubah
    if (!empty($_FILES['foto']['name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        //png,jpg,jpeg
        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        //jika extensi foto tidak ada ext yang terdaftar di array ext
        if (!in_array($extFoto, $ext)) {
            echo "Ekstensi tidak ditemukan";
            die;
        } else {
            // Pindahkan gambar dari tmp ke folder yang sudah kita buat
            // unlink() : mendelete file
            unlink('upload/' . $rowUser['cover']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
            $update = mysqli_query($koneksi, "UPDATE user SET cover ='$nama_foto' WHERE id ='$id_user'");
        }
    }
    header("location:?pg=profil&ubah=berhasil");
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover">
                <img src="<?php echo !empty($rowUser['cover']) ? 'upload/' . $rowUser['cover'] : 'https://placehold.co/100' ?>" alt="" width="100%" height="300px" class="object-fit-cover">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-header mt-3">
                <img src="<?php echo !empty($rowUser['foto']) ? 'upload/' . $rowUser['foto'] : 'https://placehold.co/100' ?> " alt="" class="rounded-circle border border-2 border-white w-25">
                <h2><?php echo $rowUser['nama_lengkap'] ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M17.03 9.78a.75.75 0 0 0-1.06-1.06l-5.47 5.47-2.47-2.47a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l6-6Z"></path>
                        <path d="m14.136 1.2 1.375 1.01c.274.201.593.333.929.384l1.687.259a3.61 3.61 0 0 1 3.02 3.021l.259 1.686c.051.336.183.655.384.929l1.01 1.375a3.61 3.61 0 0 1 0 4.272l-1.01 1.375a2.106 2.106 0 0 0-.384.929l-.259 1.687a3.61 3.61 0 0 1-3.021 3.02l-1.686.259a2.106 2.106 0 0 0-.929.384l-1.375 1.01a3.61 3.61 0 0 1-4.272 0l-1.375-1.01a2.106 2.106 0 0 0-.929-.384l-1.687-.259a3.61 3.61 0 0 1-3.02-3.021l-.259-1.686a2.117 2.117 0 0 0-.384-.929L1.2 14.136a3.61 3.61 0 0 1 0-4.272l1.01-1.375c.201-.274.333-.593.384-.929l.259-1.687a3.61 3.61 0 0 1 3.021-3.02l1.686-.259c.336-.051.655-.183.929-.384L9.864 1.2a3.61 3.61 0 0 1 4.272 0Zm-3.384 1.209-1.375 1.01a3.614 3.614 0 0 1-1.59.658l-1.686.258a2.111 2.111 0 0 0-1.766 1.766l-.258 1.686a3.61 3.61 0 0 1-.658 1.589l-1.01 1.376a2.11 2.11 0 0 0 0 2.496l1.01 1.375c.344.469.57 1.015.658 1.59l.258 1.686c.14.911.855 1.626 1.766 1.766l1.686.258a3.61 3.61 0 0 1 1.589.658l1.376 1.01a2.11 2.11 0 0 0 2.496 0l1.375-1.01a3.613 3.613 0 0 1 1.59-.657l1.686-.26a2.11 2.11 0 0 0 1.766-1.765l.258-1.686a3.61 3.61 0 0 1 .658-1.589l1.01-1.376a2.11 2.11 0 0 0 0-2.496l-1.01-1.375a3.613 3.613 0 0 1-.657-1.59l-.26-1.686a2.11 2.11 0 0 0-1.765-1.766l-1.686-.258a3.61 3.61 0 0 1-1.589-.658l-1.376-1.01a2.11 2.11 0 0 0-2.496 0Z"></path>
                    </svg></h2>
                <p><?php echo $rowUser['nama_pengguna'] ?></p>
                <p>Deskripsi Singkat</p>
            </div>
        </div>
        <div class="col-sm-6 mt-5" align="right">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profil</a>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCover">Edit Cover</a>
        </div>
        <div class="col-sm-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tweets </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tweets & Replies</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Like</button>
                </li>
                
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><?php include 'tweet.php';?></div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" value="<?php echo $rowUser['nama_lengkap'] ?>" class="form-control" placeholder="Nama" name="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <input type="text" value="<?php echo $rowUser['nama_pengguna'] ?>" class="form-control" placeholder="Username" name="nama_pengguna">
                    </div>
                    <div class="mb-3">
                        <input type="text" value="<?php echo $rowUser['email'] ?>" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //Modal kedua -->
<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cover</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="edit_cover">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>