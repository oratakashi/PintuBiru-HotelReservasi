<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PintuBiru &mdash; Hotel dan Resto Istimewa dan Syariah </title>
    <?php 
        /**
         * Untuk mendapatkan lokasi host saat ini
         * Silahkan ganti localhost/nama_foldernya
         */
        $base_url = "http://pintubiru.herokuapp.com/";
    ?>
    <base href="<?= $base_url ?>">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/modules/datatable/datatables.min.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

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
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      
    <?php 
        require 'assets/header.php';
    ?>

    <?php 
        require 'assets/navbar.php';
    ?>

      <!-- Main Content -->
    <?php 
        if($_GET['page']=='login'){
            require 'page/login/index.php';
        }elseif($_GET['page']=='register'){
            require 'page/register/index.php';
        }elseif($_GET['page']=='booking'){
            if(
                empty($_SESSION['cek_in'])&&
                empty($_SESSION['cek_out'])&&
                empty($_SESSION['dewasa'])&&
                empty($_SESSION['anak'])
              ){
                $_SESSION['anak'] = "";
                $_SESSION['dewasa'] = "";
                $_SESSION['cek_in'] = "";
                $_SESSION['cek_out'] = "";
              }
            require 'page/hotel/booking/index.php';
        }elseif($_GET['page']=='detail'){
          require 'page/hotel/booking/detail.php';
        }elseif($_GET['page']=='order'){
          if(empty($_SESSION['id_costumer'])){
            $_SESSION['last_location'] = "order/".$_GET['id'].".html";
            echo "<script>window.location.replace('login.html')</script>";
          }else{
            unset($_SESSION['last_location']);
            require 'page/hotel/booking/order.php';
          }
        }elseif($_GET['page']=='invoice'){
          if(empty($_SESSION['id_costumer'])){
            $_SESSION['last_location'] = "invoice/".$_GET['id'].".html";
            echo "<script>window.location.replace('login.html')</script>";
          }else{
            unset($_SESSION['last_location']);
            require 'page/hotel/booking/invoice.php';
          }
        }elseif($_GET['page']=='transaksi'){
          if(empty($_SESSION['id_costumer'])){
            $_SESSION['last_location'] = "transaksi.html";
            echo "<script>window.location.replace('login.html')</script>";
          }else{
            unset($_SESSION['last_location']);
            require 'page/hotel/transaksi/index.php';
          }
        }
    ?>
      
    <?php require 'assets/footer.php'; ?>
</div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/modules/datatable/datatables.min.js"></script>
  <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script> 
  <script>
    /**
        Default Configuration DataTable
     */
    $('#datatable').DataTable();
  </script>
  <script>
    var dateAndTime = function() {
      $('#m_date').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
      });
      $('#checkin_date, #checkout_date').datepicker({
        'format': 'd MM yyyy',
        'autoclose': true
      });
    };
    dateAndTime();
    $("#slider1,#slider2").owlCarousel({
      items: 1,
      nav: true,
      navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
    });
  </script>
</body>
</html>
