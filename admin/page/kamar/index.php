<?php 
    /**
     * Memanggil file2 yang di perlukan untuk halaman ini
     */
    require '../db/Kamar.php';

    /**
     * Menginstansiasi Class Kamar menjadi Object
     */
    $kamar = new Kamar();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h4>Kelola Kamar Tidur</h4>
                    <button class="btn btn-primary" id="btnSwitch">Tambah Kamar</button>
                </div>
                <!-- Tabel Data -->
                <div class="card-body" id="table">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Jml Kamar</th>
                                <th>Kamar Kosong</th>
                                <th>Harga Permalam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $data = $kamar->read();
                                $no = 1;
                                while($row = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['nama_room'] ?></td>
                                    <td><?= $row['jml_kamar'] ?></td>
                                    <td><?= $row['jml_tersedia'] ?></td>
                                    <td><?= $row['harga'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="update_data('<?= $row['id_room'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger" onclick="delete_data('<?= $row['id_room'] ?>')"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php $no++;} ?>
                        </tbody>
                    </table>           
                </div>
                <!-- Form Tambah & Form Ubah menjadi satu -->
                <div class="card-body" id="form-add">   
                    <p>Silahkan isi form berikut untuk menambahkan kamar tidur baru</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="">Nama Kamar</label>
                            <input type="text" name="room_name" id="room_name" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Kamar</label>
                                    <input type="number" name="jml_kamar" id="jml_kamar" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kamar Tersedia</label>
                                    <input type="number" name="kamar_tersedia" readonly id="kamar_tersedia" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Orang Dewasa</label>
                                    <input type="number" name="size_dewasa" id="size_dewasa" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Anak Anak</label>
                                    <input type="number" name="size_anak" id="size_anak" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Kasur</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="number" name="kasur_ranjang" id="kasur_ranjang" class="form-control" placeholder="Kasur Ranjang">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="kasur_single" id="kasur_single" class="form-control" placeholder="Kasur Single">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga Permalam</label>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                                <div class="form-group" id="upload-section">
                                    <label for="">Foto Kamar (Tambahkan seperlunya)</label>
                                    <input type="hidden" name="jml_photo" value="1" id="jml_photo">
                                    <div id="form-upload">
                                        <div id="img1" class="row">
                                            <div class="col-md-6">
                                                <input type="file" class="btn" name="img1">
                                            </div>
                                            <div class="col-md-6">
                                                <span class="btn btn-primary" onclick="tambah_photo()"><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            $file_uploaded = 0;
                            $kamar->create(
                                $_POST['id'],
                                $_POST['room_name'],
                                $_POST['jml_kamar'],
                                $_POST['size_dewasa'],
                                $_POST['size_anak'],
                                $_POST['kamar_tersedia'],
                                $_POST['kasur_ranjang'],
                                $_POST['kasur_single'],
                                $_POST['harga']
                            );
                            for($i = 1; $i<= $_POST['jml_photo']; $i++){
                                $nama_img = "img".$i;
                                $namaFile = $_FILES[$nama_img]['name'];
                                $namaSementara = $_FILES[$nama_img]['tmp_name'];
                                $dirUpload = "../media/kamar/";

                                if(move_uploaded_file($namaSementara, $dirUpload.$namaFile)){
                                    $file_uploaded++;
                                    $kamar->insertImage($_POST['id'], $namaFile);
                                    echo "<script>console.log('Berhasil Mengunggah $file_uploaded foto')</script>";
                                }
                            }
                            echo "<script>alert('Berhasil menambahkan Kamar')</script>";
                            echo "<script>window.location.replace('kamar.html')</script>";
                        }elseif(isset($_POST['btnUbah'])){
                            if(
                                !empty($_POST['room_name'])&&
                                !empty($_POST['jml_kamar'])&&
                                !empty($_POST['kamar_tersedia'])&&
                                !empty($_POST['harga'])
                                ){
                                $kamar->update($_POST['id'], $_POST['room_name'], $_POST['jml_kamar'],
                                $_POST['size_dewasa'], $_POST['size_anak'], $_POST['kamar_tersedia'], 
                                $_POST['kasur_ranjang'], $_POST['kasur_single'], $_POST['harga']);
                                echo "<script>alert('Berhasil mengubah data!')</script>";
                                echo "<script>window.location.replace('kamar.html')</script>";
                            }else{
                                print_r($_POST);
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
            atau sedang tertutup dan variabel jml_photo untuk indikator berapa photo yang aktif
         */
        var form_opened = false;
        var jml_photo = 1;
        $(document).ready(function () {
            /** 
                Mengatur secara default form tertutup ketika halaman terbuka
             */
            $('#form-add').slideUp();
            $('#btnSwitch').click(function (e) { 
                e.preventDefault();
                if(form_opened){
                    /**
                        Menghapus semua inputan di form ketika menekan tombol batal
                        dan menghapus id yang tersimpan di form
                     */
                    $('#btnSwitch').html('Tambah Kamar');
                    $('#btnSwitch').removeClass('btn-danger');
                    $('#btnSwitch').addClass('btn-primary');
                    $('#table').slideDown();
                    $('#form-add').slideUp();
                    $('input').val('');
                    $('#btnSubmit').prop('name', 'btnTambah');
                    $('#upload-section').slideDown();
                    form_opened = false;
                }else{
                    /**
                        Jika membuka form tambah kamar, maka akan meminta id ke webservice.php secara async
                        dan ID yang di dapatkan dari webservice akan di set ke input type hidden 
                        yang ada di form tambah
                     */
                    $.ajax({
                        type: "get",
                        url: "api/id/kamar",
                        dataType: "json",
                        success: function (response) {
                            $('#id').val(parseInt(response.id_room)+1);
                        }
                    });
                    $('#btnSwitch').html('Batal');
                    $('#btnSwitch').removeClass('btn-primary');
                    $('#btnSwitch').addClass('btn-danger');
                    $('#table').slideUp();
                    $('#form-add').slideDown();
                    form_opened = true;
                }
            });
            /**
                method untuk mengcopy apapun yang di input di jml kamar 
                ke kamar tersedia
             */
            $('#jml_kamar').keyup(function (e) { 
                if($('#btnSubmit').prop('name')=='btnTambah'){
                    $('#kamar_tersedia').val($('#jml_kamar').val());
                }
            });
        });
        /**
            Fungsi untuk mengambil detail Hotel dari webservice.php
            dan di tampilkan ke form tambah
            serta merubah form tambah menjadi form edit
        */
        function update_data(id) { 
            $.ajax({
                type: "get",
                url: "api/detail/kamar/"+id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('#id').val(response.id_room);
                    $('#room_name').val(response.nama_room);
                    $('#jml_kamar').val(response.jml_kamar);
                    $('#kamar_tersedia').val(response.jml_tersedia);
                    $('#size_dewasa').val(response.size_dewasa);
                    $('#size_anak').val(response.size_anak);
                    $('#kasur_ranjang').val(response.kasur_ranjang);
                    $('#kasur_single').val(response.kasur_single);
                    $('#harga').val(response.harga);
                    $('#btnSubmit').prop('name', 'btnUbah');
                    $('#btnSwitch').html('Batal');
                    $('#btnSwitch').removeClass('btn-primary');
                    $('#btnSwitch').addClass('btn-danger');
                    $('#table').slideUp();
                    $('#form-add').slideDown();
                    $('#upload-section').slideUp();
                    form_opened = true;
                }
            });
        }
        
        /**
            Method untuk menambah foto di modul tambah kamar
            dengan method ini memungkinkan pengguna mengupload foto lebih dari satu
         */
        function tambah_photo() { 
            jml_photo += 1;
            $('#jml_photo').val(jml_photo);
            $('#form-upload').append(
                `
                    <div id="img`+jml_photo+`" class="row">
                        <div class="col-md-6">
                            <input type="file" class="btn" name="img`+jml_photo+`">
                        </div>
                        <div class="col-md-6">
                            <span class="btn btn-primary" onclick="tambah_photo()"><i class="fas fa-plus"></i></span>
                        </div>
                    </div>
                `
            );
        }

        function delete_data(id) { 
            iziToast.warning({
                title: 'Background Progress',
                message: 'Menjalakan penghapusan data!',
                position: 'topRight'
            });
            $.ajax({
                type: "get",
                url: "api/delete/kamar/"+id,
                dataType: "json",
                success: function (response) {
                    if(response.status==200){
                        iziToast.success({
                            title: 'Background Progress',
                            message: 'Pengapusan data berhasil!',
                            position: 'topRight'
                        });
                        window.location.replace('kamar.html');
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