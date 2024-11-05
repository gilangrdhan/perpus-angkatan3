<?php
require_once "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $userId = $_POST['user_id'];
    echo $statusId = $_POST['status_id'];
    echo $commentText = mysqli_real_escape_string($koneksi, $_POST['comment_text']);


    $query = mysqli_query($koneksi, "INSERT INTO comments (user_id, status_id, comment_text, created_at) VALUES ($userId, $statusId, '$commentText', NOW())");

    if ($query) {
        header("location: index.php?pg=profil");
        exit();
    }
}

//         if(mysqli_query($koneksi, $query)){
//             echo json_encode(["status"=>"success", "message"=>"Komentar Berhasil ditambah"]);

//         }else{
//             echo json_encode(["status"=>"error", "message"=>"Komentar Gagal ditambah" . mysqli_error($koneksi)]);
//         }
//     }else{
//         echo json_encode(["status"=>"error", "message"=>"Komentar tidak boleh kosong"]);

// }
// }
// exit();
