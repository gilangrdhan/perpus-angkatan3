<?php
if (isset($_POST['posting'])) {
    $content = $_POST['content'];


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
            unlink('upload/' . $rowTweet['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
            $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user, foto) VALUES ('$content','$id_user', '$nama_foto')");
        }
    } else {
        //gambar tidak mau diubah
        $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user) VALUES ('$content','$id_user')");
    }
    header("location:?pg=profil&ubah=berhasil");
}
$queryPosting  = mysqli_query($koneksi, "SELECT tweet.* FROM tweet WHERE id_user = '$id_user'");
?>

<div class="row">
    <div class="col-sm-12" align="right">
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Tweet</button>

    </div>
    <div class="col-sm-12 mt-3">
        <?php while ($rowPosting = mysqli_fetch_assoc($queryPosting)): ?>
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : 'https://placehold.co/100' ?>" alt="..." width="100" class="border border-2 rounded-circle">
                </div>
                <div class="flex-grow-1 ms-3">
                    <?php if (!empty($rowPosting['foto'])): ?>
                        <img src="upload/<?php echo $rowPosting['foto'] ?>" alt="" width=300>
                    <?php endif ?>
                    <?php echo $rowPosting['content'] ?>
                </div>
<!-- //like -->
                        <div class="status mt-1">
                        <input type="text" id="user_id_like" value ="<?php echo $rowPosting['id_user']?>">
                        <button class="btn btn-success btn-sm"onclick="toogleLike(<?php echo $rowPosting['id'];?>)">Like</button>
                        </div>

                <div class="flex-grow-1 ms-3">
                    <form method="POST" action="add_comment.php">
                        <input type="hidden" name="status_id" value="<?php echo $rowPosting['id'] ?>">
                        <input type="hidden" name="user_id" value="<?php echo $rowPosting['id_user'] ?>">
                        <textarea class="form-control" name="comment_text" id="comment_text" cols="5" rows="5" placeholder="Tulis balasan Anda"></textarea>
                        <button class="btn btn-primary btn-sm mt-2" type="submit">Kirim balasan</button>
                    </form>
                </div>

                <div class="mt-2 alert" id="comment-alert" style="display:none;"></div>
                <div class="mt-1">
                    <?php
                    if (isset($rowPosting['id']) && isset($rowPosting['id_user'])) {
                        $idStatus = $rowPosting['id'];
                        $userId = $rowPosting['id_user'];
                        $queryComment = mysqli_query($koneksi, "SELECT * FROM comments WHERE status_id = $idStatus AND user_id = $userId");
                        $rowCounts = mysqli_fetch_all($queryComment, MYSQLI_ASSOC);

                        foreach ($rowCounts as $rowCount) {

                    ?>
                            <span>
                                <pre>Komentar: <?php echo $rowCount['comment_text'] ?></pre>
                            </span>
                    <?php
                        }
                    }
                    ?>
                </div>


            </div>
        <?php endwhile ?>


    </div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tweet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="mb-3">
                        <textarea name="content" id="summernote"></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="posting">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("add_comment.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertBox = document.getElementById('comment-alert');
                if (data.status === "success") {
                    alertBox.className = "alert alert-success";
                    alertBox.innerHTML = data.message;
                    //bersihkan textarea
                    document.getElementById('comment_text').value = '';
                    location.reload();

                } else {
                    alertBox.className = "alert alert-danger";
                    alertBox.innerHTML = data.message;
                }
                alertBox.style.display = "block";
            })
            .catch(error => console.error("error:", error));
    });
</script> -->