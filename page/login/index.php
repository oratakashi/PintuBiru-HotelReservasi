<?php 
    if(!empty($_SESSION['id_costumer'])){
        echo "<script>window.location.replace('profile.html')</script>";
    }
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body" id="login">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="assets/login.svg" alt="" srcset="">
                        </div>
                        <div class="col-md-5">
                            <h4>Login</h4>
                            <p>Silahkan isi alamat email dan kata sandi anda</p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Alamat Email</label>
                                    <input type="text" name="email" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kata Sandi</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <span class="btn btn-danger float-right" id="btnDaftar">Daftar Sekarang</span>
                                    <button class="btn btn-primary float-right" style="margin-right:10px" type="submit">Login</button>
                                </div>
                            </form>
                            <?php 
                                /**
                                 * Form Action Daftar
                                 */

                                require 'db/Customer.php';
                                $customer = new Customer();
                                if(!empty($_POST)){
                                    if(
                                        !empty($_POST['email'])&&
                                        !empty($_POST['password'])
                                    ){
                                    $login = $customer->login($_POST['email'], sha1($_POST['password']) );
                                    if($login->rowCount()==1){
                                        $data = $login->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['id_costumer'] = $data['id_costumer'];
                                        $_SESSION['nama'] = $data['nama_costumer'];
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['photo'] = $data['photo'];
                                        if(empty($_SESSION['last_location'])){
                                            echo "<script>window.location.replace('booking.html')</script>";
                                        }else{
                                            echo "<script>window.location.replace('".$_SESSION['last_location']."')</script>";
                                        }
                                    }else{
                                        echo "Email / Password tidak ditemukan!";
                                    }
                                    
                                    }else{
                                        echo "<script>alert('Gagal Melakukan pendaftaran!')</script>";
                                        echo "<script>window.location.replace('register.html')</script>";
                                    }
                                }
                            ?>
                            <script>
                                $('#btnDaftar').click(function (e) { 
                                    e.preventDefault();
                                    window.location.replace('register.html');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>