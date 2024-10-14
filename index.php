<?php include 'koneksi.php';

session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css" />
  <!-- Include Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet"
    href="https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-straight/css/uicons-bold-straight.css" />
  <title>Perpus</title>
</head>

<body>
  <div class="wrapper">
    <?php
    require_once "inc/navbar.php";
    ?>

    <div class="content">
      <?php
      if (isset($_GET['pg'])) {
        if (file_exists('content/' . $_GET['pg'] . '.php')) {
          include('content/' . $_GET['pg'] . '.php');
        }
      } else {
        include 'content/dashboard.php';
      }
      ?>
    </div>




    <!-- Footer -->
    <footer class="text-center border-top border-dark border-2 fixed-bottom p-3">
      Copyright &copy; 2024 PPKD - Jakarta Pusat.
    </footer>
    <?php
    require_once "inc/footer.php";
    ?>
  </div>
</body>

</html>