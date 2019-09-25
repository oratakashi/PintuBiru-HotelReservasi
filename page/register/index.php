<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body" id="login">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="assets/register.svg" alt="" srcset="">
                        </div>
                        <div class="col-md-5">
                            <h4>Daftar</h4>
                            <p>Silahkan isi alamat email dan kata sandi anda</p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="jk" id="" class="form-control">
                                        <option value="">Pilih Jenis kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Email</label>
                                    <input type="text" name="email" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kata Sandi</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <span class="btn btn-danger float-right" id="btnLogin">Sudah Punya Akun</span>
                                    <button class="btn btn-primary float-right" style="margin-right:10px" type="submit">Daftar</button>
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
                                    !empty($_POST['nama'])&&
                                    !empty($_POST['jk'])&&
                                    !empty($_POST['email'])&&
                                    !empty($_POST['password'])
                                    ){
                                    $customer->create($_POST['nama'], $_POST['jk'], $_POST['email'],
                                        sha1($_POST['password']) );
                                    echo "<script>alert('Berhasil Melakukan pendaftaran!')</script>";
                                    echo "<script>window.location.replace('login.html')</script>";
                                    }else{
                                        echo "<script>alert('Gagal Melakukan pendaftaran!')</script>";
                                        echo "<script>window.location.replace('register.html')</script>";
                                    }
                                 }
                            ?>
                            <script>
                                $('#btnLogin').click(function (e) { 
                                    e.preventDefault();
                                    window.location.replace('login.html');
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>