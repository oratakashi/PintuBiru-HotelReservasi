<?php 
    /**
     * Memanggil file2 yang di perlukan untuk halaman ini
     */
    require '../db/Resto.php';

    /**
     * Menginstansiasi Class Resto menjadi Object
     */
    $resto = new Resto();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h4>Kelola Menu Restaurant</h4>
                    <button class="btn btn-primary" id="btnSwitch">Tambah Menu</button>
                </div>
                <!-- Tabel Data -->
                <div class="card-body" id="table">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $data = $resto->read();
                                while($row = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['nama_food'] ?></td>
                                    <td><?= $row['kategori'] ?></td>
                                    <td><?= $row['harga'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="update_data('<?= $row['id_food'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger" onclick="delete_data('<?= $row['id_food'] ?>')"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php $no++;} ?>
                        </tbody>
                    </table>            
                </div>
                <!-- Form Tambah & Form Ubah menjadi satu -->
                <div class="card-body" id="form-add">   
                    <p>Silahkan isi form berikut untuk menambahkan menu baru</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="">Nama Menu</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                        <option value="Desert">Desert</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Harga Menu</label>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6" id="div_deskripsi">
                                    <label for="">Deskripsi Singkat ( <span id="jml_char">120</span> Karakter )</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="20"></textarea>
                                </div>
                                <div class="col-md-6" id="upload_photo">
                                    <label for="">Upload Gambar</label>
                                    <div class="row">
                                        <input type="file" name="photo" id="photo" class="btn">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btnSubmit" name="btnTambah" class="btn btn-primary col-md-12">Simpan</button>
                        </div>
                    </form>
                    <?php 
                        /**
                         * Dilakukan pengecekan apakah form yang di submit form tambah
                         * atau form edit, jika form tambah maka akan memanggil method create
                         * dan jika form edit akan memanggil method edit
                         */
                        if(isset($_POST['btnTambah'])){
                            $namaFile = $_FILES['photo']['name'];
                            $namaSementara = $_FILES['photo']['tmp_name'];
                            $dirUpload = "../media/food/";

                            if(move_uploaded_file($namaSementara, $dirUpload.$namaFile)){
                                echo "<script>console.log('Berhasil Mengunggah $namaFile')</script>";
                            }
                            $resto->create($_POST['nama'], $_POST['harga'], $_POST['kategori'], 
                                    $_POST['deskripsi'], $namaFile);
                            echo "<script>alert('Berhasil menambahkan Menu')</script>";
                            echo "<script>window.location.replace('food.html')</script>";
                        }elseif(isset($_POST['btnUbah'])){
                            if( !empty($_POST['nama'])&&
                                !empty($_POST['harga'])&&
                                !empty($_POST['kategori'])&&
                                !empty($_POST['deskripsi'])){
                                $resto->update( $_POST['id'], $_POST['nama'], $_POST['harga'], $_POST['kategori'], 
                                                $_POST['deskripsi']);
                                echo "<script>alert('Berhasil mengubah data!')</script>";
                                echo "<script>window.location.replace('food.html')</script>";
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
                    $('#btnSwitch').html('Tambah Menu');
                    $('#btnSwitch').removeClass('btn-danger');
                    $('#btnSwitch').addClass('btn-primary');
                    $('#table').slideDown();
                    $('#form-add').slideUp();
                    $('#upload_photo').slideDown();
                    $('#div_deskripsi').removeClass('col-md-12');
                    $('#div_deskripsi').addClass('col-md-6');
                    $('input').val('');
                    $('#deskripsi').val('');
                    $('#kategori').val('');
                    $('#jml_char').html(120);
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
            $('#deskripsi').keydown(function (e) { 
                hitung_karakter();
            });
            $('#deskripsi').keyup(function (e) { 
                hitung_karakter();
            });
        });
        
        /**
         * Fungsi untuk menghitung karakter
         */
        function hitung_karakter() { 
            if($('#deskripsi').val()==''){
                $('#jml_char').html(120);
                $('#jml_char').prop('style', '');
            }else{
                var cs = $('#deskripsi').val().length;
                $('#jml_char').html(120-cs);
                if(cs > 120){
                    $('#jml_char').prop('style', 'color:red');
                }else{
                    $('#jml_char').prop('style', '');
                }
            }
        }
        /**
            Fungsi untuk mengambil detail Menu dari webservice.php
            dan di tampilkan ke form tambah
            serta merubah form tambah menjadi form edit
        */
        function update_data(id) { 
            $.ajax({
                type: "get",
                url: "api/detail/food/"+id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('#nama').val(response.nama_food);
                    $('#id').val(response.id_food);
                    $('#harga').val(response.harga);
                    $('#deskripsi').val(response.deskripsi);
                    $('#kategori').val(response.kategori);
                    $('#jml_char').html(120-response.deskripsi.length);
                    $('#upload_photo').slideUp();
                    $('#div_deskripsi').removeClass('col-md-6');
                    $('#div_deskripsi').addClass('col-md-12');
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

        function delete_data(id) { 
            iziToast.warning({
                title: 'Background Progress',
                message: 'Menjalakan penghapusan data!',
                position: 'topRight'
            });
            $.ajax({
                type: "get",
                url: "api/delete/food/"+id,
                dataType: "json",
                success: function (response) {
                    if(response.status==200){
                        iziToast.success({
                            title: 'Background Progress',
                            message: 'Pengapusan data berhasil!',
                            position: 'topRight'
                        });
                        window.location.replace('food.html');
                    }else{
                        iziToast.error({
                            title: 'Background Progress',
                            message: 'Pengapusan data gagal!',
                            position: 'topRight'
                        });
                    }
                }
            });
        }
    </script>
</div>