<?php 
    /**
     * Memanggil file2 yang di perlukan untuk halaman ini
     */
    require '../db/Customer.php';

    /**
     * Menginstansiasi Class Admin menjadi Object
     */
    $customer = new Customer();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h4>Kelola Customer</h4>
                </div>
                <!-- Tabel Data -->
                <div class="card-body" id="table">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Nama Customer</th>
                                <th>Email</th>
                                <th>Tgl Mendaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                /**
                                 * Mengambil data costumer dengan memanggil method read costumer
                                 * yang berada di class costumer
                                 */
                                $data = $customer->read();
                                $no = 1;
                                while($row = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <figure class="avatar mr-2">
                                            <img src="../media/photo/<?= $row['photo'] ?>" class="img-round" alt="" srcset="">
                                        </figure>
                                    </td>
                                    <td><?= $row['nama_costumer'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td>
                                        <?= $row['created_date'] ?>
                                    </td>
                                </tr>
                            <?php } ?>
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
                <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        
        $(document).ready(function () {
            
        });
        /**
            Fungsi untuk mengambil detail Costumer dari webservice.php
            dan di tampilkan ke modal
        */
        function detail_data(id) { 
            $.ajax({
                type: "get",
                url: "api/detail/administrator/"+id,
                dataType: "json",
                success: function (response) {
                    
                }
            });
         }
    </script>
</div>