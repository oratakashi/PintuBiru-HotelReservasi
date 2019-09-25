<?php 
    /**
     * Memanggil file file yang di perlukan
     */

     require 'db/Kamar.php';

     $kamar = new Kamar();

     $data = $kamar->read_detail($_GET['id'])->fetch(PDO::FETCH_ASSOC);

?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h6>Konfirmasi Pesanan</h6>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/order.svg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Informasi Kamar</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nama Kamar</td>
                                        <td><?= $data['nama_room'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Permalam</td>
                                        <td><?= $data['harga'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/><hr/><br/>
                            <?php 
                                /**
                                 * Script ini untuk mengambil ID dari file webservice.php
                                 */
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://localhost/hotel/api/id/order");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $detail = json_decode($result, true);
                            ?>
                            <form action="invoice/<?= $detail['id_order'] ?>.html" method="post">
                                <h5>Detail Pesanan</h5>
                                <input type="hidden" name="nama_room" value="<?= $data['nama_room'] ?>">
                                <input type="hidden" name="harga" value="<?= $data['harga'] ?>">
                                <input type="hidden" name="id_room" value="<?= $data['id_room'] ?>">
                                <div class="form-group">
                                    <label for="">Nomor Pemesan</label>
                                    <input type="text" name="id_order" readonly id="" value="<?= $detail['id_order'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pemesan</label>
                                    <input type="text" name="" readonly id="" value="<?= $_SESSION['nama'] ?>" class="form-control">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Check In</label>
                                            <input type="text" readonly name="cek_in" value="<?= $_SESSION['cek_in'] ?>" id="checkin_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Check Out</label>
                                            <input type="text" readonly name="cek_out" value="<?= $_SESSION['cek_out'] ?>" id="checkout_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Berapa Orang ?</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="dewasa" id="" class="form-control">
                                                <option value="1" <?php if($_SESSION['dewasa'] == 1){echo "selected";} ?>>1 Dewasa</option>
                                                <option value="2" <?php if($_SESSION['dewasa'] == 2){echo "selected";} ?>>2 Dewasa</option>
                                                <option value="3" <?php if($_SESSION['dewasa'] == 3){echo "selected";} ?>>3 Dewasa</option>
                                                <option value="4" <?php if($_SESSION['dewasa'] == 4){echo "selected";} ?>>4+ Dewasa</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="anak" id="" class="form-control">
                                                <option value="0" <?php if($_SESSION['anak'] == 0){echo "selected";} ?>>0 Anak</option>
                                                <option value="1" <?php if($_SESSION['anak'] == 1){echo "selected";} ?>>1 Anak</option>
                                                <option value="2" <?php if($_SESSION['anak'] == 2){echo "selected";} ?>>2 Anak</option>
                                                <option value="3" <?php if($_SESSION['anak'] == 3){echo "selected";} ?>>3 Anak</option>
                                                <option value="4" <?php if($_SESSION['anak'] == 4){echo "selected";} ?>>4+ Anak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </section>
</div>