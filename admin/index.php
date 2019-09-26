<?php 
    /**
     * Selamat Datang di Project PintuBiru
     * Ini Merupakan Project Untuk Belajar bagi Pemula
     * 
     * Jika ada pertanyaan silahkan hubungi :
     * Facebook   : https://facebook.com/keisya.annajma
     * Github     : https://github.com/oratakashi
     * 
     * Project ini di develop oleh : Oratakashi Nhamako & Keisya Puspitasari
     * Dan Menggunakan Template dari Muhammad Nauval Azhar (https://getstisla.com)
     * 
     * Catatan :
     * 1. Semua halaman di sini yang menggunakan akhiran (.html) dan akan di redirect ke index.php
     *    dan semua halaman api akan redirect ke file webservice.php
     * 2. Untuk pemprosesan data di lakukan di class tiap modul yang ada di folder DB
     * 3. Untuk bisnis Logic yang simpel ada di tiap file php di folder page, dan jika ada bisnis logic
     *    yang rumit berada di file webservice.php
     * 
     * * Note :   Silahkan beri masukan sekiranya penjelasan di documentation salah / kurang tepat
     *            karena saya hanya manusia biasa yang punya salah dan khilaf
     */

     /**
      * Di Awal File Akan memeriksa Session yang Login
      * Jika Belum melakukan login maka akan redirect ke login.html
      */
    session_start();
    if(empty($_SESSION['id_admin'])){
        header("location: login.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Pintu Biru Admin</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/modules/datatable/datatables.min.css">

  <!-- Requried JS Script -->
  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
  <script src="assets/modules/jquery.min.js"></script>
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        <!-- Memanggil Navbar -->
        <?php require 'assets/navbar.php'; ?>

        <!-- Memanggil Sidebar -->
        <?php require 'assets/sidebar.php'; ?>

      <!-- Memanggil Content -->
      <?php 
        if(empty($_GET['page'])){
          require 'page/beranda.php';
        }elseif($_GET['page']=='administrator'){
          require 'page/administrator/index.php';
        }elseif($_GET['page']=='kamar'){
          require 'page/kamar/index.php';
        }elseif($_GET['page']=='customer'){
          require 'page/costumer/index.php';
        }elseif($_GET['page']=='transaksi'){
          require 'page/transaksi/index.php';
        }
      ?>
      
      <!-- Memanggil Footer -->
      <?php require 'assets/footer.php'; ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="assets/modules/chart.min.js"></script>
  <script src="assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index-0.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/modules/datatable/datatables.min.js"></script>
  <script>
    /**
        Default Configuration DataTable
     */
    $('#datatable').DataTable();
  </script>
</body>
</html>