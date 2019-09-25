<?php 
    /**
     * Memanggil file file yang di perlukan
     */

     require 'db/Order.php';

     $order = new Order();

     if(empty($_POST)){
         echo "<script>window.location.replace('booking.html')</script>";
     }

?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/invoice.svg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Tagihan Pembayaran</h5>
                            <h2 class="text-primary"><?= $_GET['id'] ?></h2>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <h6>Segera lakukan pembayaran sebelum : </h6>
                            <h3><?= date('d M Y') ?> - 23:59 WIB</h3>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <h6>Detail Pemesanan</h6>
                            <table class="table">
                                <tr>
                                    <td>Atas Nama</td>
                                    <td><?= $_SESSION['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Kamar</td>
                                    <td><?= $_POST['nama_room'] ?></td>
                                </tr>
                                <tr>
                                    <td>Harga Permalam</td>
                                    <td>Rp. <?= $_POST['harga'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek In</td>
                                    <td>Rp. <?= $_POST['cek_in'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek Out</td>
                                    <td>Rp. <?= $_POST['cek_out'] ?></td>
                                </tr>
                                <tr>
                                    <td>Di pesan untuk</td>
                                    <td><?= $_POST['dewasa'] ?> Dewasa dan <?= $_POST['anak'] ?> anak-anak</td>
                                </tr>
                            </table>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <div class="text-right">
                                <?php 
                                    $date1 = date_create($_POST['cek_in']);
                                    $date2 = date_create($_POST['cek_out']);
                                    
                                    //difference between two dates
                                    $diff = date_diff($date1,$date2);
                                ?>
                                <p>Total ( <?= $diff->d ?> Malam )</p>
                                <h3 class="text-primary">Rp. <?php echo ($diff->d * $_POST['harga']); ?></h3>
                            </div>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <div>
                                <p>Pembayaran dapat di lakukan di :</p>
                                <img src="assets/logoalfa.png" alt="" srcset="" style="width:100px;hight:30px">
                            </div>
                            <div>
                                <a href="transaksi.html" class="btn btn-primary float-right">Tutup</a>
                            </div>
                            <?php 
                                if($order->cekID($_GET['id'])){
                                    $cek_in = date('Y-m-d', strtotime($_POST['cek_in']));
                                    $cek_out = date('Y-m-d', strtotime($_POST['cek_out']));
                                    $total = ($diff->d * $_POST['harga']);
                                    $debug = $order->create($_GET['id'], $cek_in, $cek_out, $_SESSION['id_costumer'],
                                    $_POST['id_room'], $total);
                                }
                            ?>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </section>
</div>