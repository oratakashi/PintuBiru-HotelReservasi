<?php 
    /**
     * Memanggil file file yang di perlukan
     */

     require 'db/Kamar.php';

     $kamar = new Kamar();

     $data = $kamar->read_detail($_GET['id'])->fetch(PDO::FETCH_ASSOC);
     $photo = $kamar->read_photo($_GET['id'])->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="owl-carousel owl-theme slider" id="slider1">
                                <?php 
                                    foreach ($photo as $row) {
                                ?>
                                    <div><img alt="image" src="media/kamar/<?= $row['photos'] ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3 style="margin-top:10px"><?= $data['nama_room'] ?> </h3>
                            <span class="badge badge-info float-right" style="margin-top:-30px">Tersisa <?= $data['jml_tersedia'] ?> Kamar</span>
                            <h5 class="text-primary">Rp. <?= $data['harga'] ?></h5>
                            <hr>
                            <h5>Fasilitas</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Kasur Single</td>
                                            <td><?= $data['kasur_single'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kasur Double</td>
                                            <td><?= $data['kasur_ranjang'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Wifi</td>
                                            <td>Ya</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Sarapan Gratis</td>
                                            <td>Ya</td>
                                        </tr>
                                        <tr>
                                            <td>Kopi / Teh Gratis</td>
                                            <td>Ya</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="order/<?= $_GET['id'] ?>.html" class="btn btn-primary col-md-12">Pesan Sekarang</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>