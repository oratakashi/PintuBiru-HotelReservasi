<?php 
    session_start();
    if(isset($_SESSION['id_admin'])){
        header("location: index.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; PintuBiru</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                Pintu<span class="text-info">Biru</span>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <?php 
                        if(empty($_POST)){
                    ?>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <?php }else{ ?>
                        <input id="email" type="email" class="form-control" value="<?= $_POST['email'] ?>" name="email" tabindex="1" required autofocus>
                    <?php } ?>
                    <div class="invalid-feedback">
                      Silahkan isi alamat email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Kata Sandi</label>
                    </div>
                    <?php 
                        if(empty($_POST)){
                    ?>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <?php } else { ?>
                        <input id="password" type="password" class="form-control" value="<?= $_POST['password'] ?>" name="password" tabindex="2" required>
                    <?php } ?>
                    <div class="invalid-feedback">
                      Silahkan isi kata sandi
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <?php 
                /**
                 * Form Action
                 * 
                 * Script untuk menjalankan fungsi form login
                 */
                    require '../db/Admin.php';
                    if(!empty($_POST)){
                        $admin = new Admin();
                        $data = $admin->login($_POST['email'], $_POST['password']);
                        if($data->rowCount()>0){
                            $data = $data->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['id_admin'] = $data['id_admin'];
                            $_SESSION['nama'] = $data['nama'];
                            $_SESSION['email'] = $data['email'];
                            $_SESSION['photo'] = $data['photo'];
                            header('location: index.html');
                        }else{
                            echo "Email dan Password tidak ditemukan!";
                        }
                    }
                ?>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; PintuBiru <?= date('Y') ?>
            </div>
          </div>
        </div>
      </div>
    </section>
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
</body>
</html>