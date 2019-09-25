<?php 
    /**
     * Memanggil file2 yang di perlukan untuk halaman ini
     */
    require '../db/Admin.php';

    /**
     * Menginstansiasi Class Admin menjadi Object
     */
    $admin = new Admin();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h4>Kelola Administrator</h4>
                    <button class="btn btn-primary" id="btnSwitch">Tambah Data</button>
                </div>
                <!-- Tabel Data -->
                <div class="card-body" id="table">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Nama Administrator</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                /**
                                 * Mengambil data admin dengan memanggil method read admin
                                 * yang berada di class Admin
                                 */
                                $data = $admin->read();
                                $no = 1;
                                while($row = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <figure class="avatar mr-2">
                                            <img src="../media/photo/<?= $row['photo'] ?>" class="img-round" alt="" srcset="">
                                        </figure>
                                    </td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="update_data('<?= $row['id_admin'] ?>')"><i class="fas fa-user-edit"></i></button>
                                        <a href="api/administrator/delete/<?= $row['id_admin'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php $no++;} ?>
                        </tbody>
                    </table>           
                    <?php 
                        /**
                         * Script ini digunakan untuk menghandle jika ada perintah untuk menghapus
                         * data administrator
                         */
                        if(!empty($_GET['id'])){
                            $admin->delete($_GET['id']);
                            echo "<script>alert('Berhasil menghapus Administrator')</script>";
                            echo "<script>window.location.replace('../../../administrator.html')</script>";
                        }
                    ?>             
                </div>
                <!-- Form Tambah & Form Ubah menjadi satu -->
                <div class="card-body" id="form-add">   
                    <p>Silahkan isi form berikut untuk menambahkan administrator baru</p>
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="namadpn" id="namadpn" class="form-control" placeholder="Nama Depan">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="namablk" id="namablk" class="form-control" placeholder="Nama Belakang">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Alamat Email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Kata Sandi">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary col-md-12" type="submit" id="btnSubmit" name="btnTambah">Simpan</button>
                        </div>
                    </form>
                    <?php 
                        /**
                         * Dilakukan pengecekan apakah form yang di submit form tambah
                         * atau form edit, jika form tambah maka akan memanggil method create
                         * dan jika form edit akan memanggil method edit
                         */
                        if(isset($_POST['btnTambah'])){
                            if(!empty($_POST['namadpn'])&&!empty($_POST['namablk'])&&!empty($_POST['email'])&&!empty($_POST['password'])){
                                $admin->create($_POST['namadpn'].' '.$_POST['namablk'], $_POST['email'], sha1($_POST['password']), 'Administrator');
                                echo "<script>alert('Berhasil menambahkan Administrator')</script>";
                                echo "<script>window.location.replace('administrator.html')</script>";
                            }else{
                                echo "<script>alert('Gagal menambahkan data')</script>";
                            }
                        }elseif(isset($_POST['btnUbah'])){
                            if(!empty($_POST['namadpn'])&&!empty($_POST['namablk'])&&!empty($_POST['email'])&&!empty($_POST['password'])){
                                $admin->update($_POST['id'], $_POST['namadpn'].' '.$_POST['namablk'], $_POST['email'], sha1($_POST['password']));
                                echo "<script>alert('Berhasil mengubah data!')</script>";
                                echo "<script>window.location.replace('administrator.html')</script>";
                            }else{
                                echo "<script>alert('Gagal mengubah data')</script>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script>
        /**
            variabel form_opened untuk memeriksa apakah form sedang terbuka
            atau sedang tertutup
         */
        var form_opened = false;
        $(document).ready(function () {
            /** 
                Mengatur secara default form tertutup ketika halaman terbuka
             */
            $('#form-add').slideUp();
            $('#btnSwitch').click(function (e) { 
                e.preventDefault();
                if(form_opened){
                    $('#btnSwitch').html('Tambah Data');
                    $('#btnSwitch').removeClass('btn-danger');
                    $('#btnSwitch').addClass('btn-primary');
                    $('#table').slideDown();
                    $('#form-add').slideUp();
                    $('input').val('');
                    $('#btnSubmit').prop('name', 'btnTambah');
                    form_opened = false;
                }else{
                    $('#btnSwitch').html('Batal');
                    $('#btnSwitch').removeClass('btn-primary');
                    $('#btnSwitch').addClass('btn-danger');
                    $('#table').slideUp();
                    $('#form-add').slideDown();
                    form_opened = true;
                }
            });
        });
        /**
            Fungsi untuk mengambil detail Administrator dari webservice.php
            dan di tampilkan ke form tambah
            serta merubah form tambah menjadi form edit
        */
        function update_data(id) { 
            $.ajax({
                type: "get",
                url: "api/detail/administrator/"+id,
                dataType: "json",
                success: function (response) {
                    var nama = response.nama;
                    nama = nama.split(' ');
                    $('#namadpn').val(nama[0]);
                    $('#namablk').val(nama[1]);
                    $('#email').val(response.email);
                    $('#id').val(response.id_admin);
                    $('#btnSubmit').prop('name', 'btnUbah');
                    $('#btnSwitch').html('Batal');
                    $('#btnSwitch').removeClass('btn-primary');
                    $('#btnSwitch').addClass('btn-danger');
                    $('#table').slideUp();
                    $('#form-add').slideDown();
                    form_opened = true;
                }
            });
         }
    </script>
</div>