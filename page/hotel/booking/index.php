<?php 
    /**
     * Memanggil file file yang di perlukan
     */

     require 'db/Kamar.php';

     $kamar = new Kamar();
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <?php 
                        if(!empty($_POST)){
                            $_SESSION['cek_in'] = $_POST['cek_in'];
                            $_SESSION['cek_out'] = $_POST['cek_out'];
                            $_SESSION['dewasa'] = $_POST['dewasa'];
                            $_SESSION['anak'] = $_POST['anak'];
                        }
                    ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                                <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                <input type="text" id="checkin_date" class="form-control" value="<?= $_SESSION['cek_in'] ?>" name="cek_in">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkout_date" class="font-weight-bold text-black" >Check Out</label>
                                <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                    <input type="text" id="checkout_date" name="cek_out" class="form-control" value="<?= $_SESSION['cek_out'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="adults" class="font-weight-bold text-black">Dewasa</label>
                                        <div class="field-icon-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="dewasa" id="adults" name="dewasa" class="form-control">
                                            <option value="1" <?php if($_SESSION['dewasa'] == 1){echo "selected";} ?>>1</option>
                                            <option value="2" <?php if($_SESSION['dewasa'] == 2){echo "selected";} ?>>2</option>
                                            <option value="3" <?php if($_SESSION['dewasa'] == 3){echo "selected";} ?>>3</option>
                                            <option value="4" <?php if($_SESSION['dewasa'] == 4){echo "selected";} ?>>4+</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="children" class="font-weight-bold text-black">Anak</label>
                                        <div class="field-icon-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="anak" id="children" name="anak" class="form-control">
                                            <option value="0" <?php if($_SESSION['anak'] == 0){echo "selected";} ?>>0</option>
                                            <option value="1" <?php if($_SESSION['anak'] == 1){echo "selected";} ?>>1</option>
                                            <option value="2" <?php if($_SESSION['anak'] == 2){echo "selected";} ?>>2</option>
                                            <option value="3" <?php if($_SESSION['anak'] == 3){echo "selected";} ?>>3</option>
                                            <option value="4" <?php if($_SESSION['anak'] == 4){echo "selected";} ?>>4+</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 align-self-end">
                                <button class="btn btn-primary btn-block text-white" name="btnSubmitClient" type="submit">Check Kamar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <th>No</th>
                            <th>Nama Kamar</th>
                            <th>Kamar Tersisa</th>
                            <th>Harga</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php 
                                /**
                                 * Bisnis Logic (Alur Bisnisnya)
                                 */
                                if(!empty($_POST)){
                                    $data = $kamar->read();
                                    $no = 1;
                                    while($row = $data->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_room'] ?></td>
                                <td><?= $row['jml_tersedia'] ?></td>
                                <td>Rp. <?= $row['harga'] ?></td>
                                <td>
                                    <a href="detail/<?= $row['id_room'] ?>.html" class="btn btn-primary">Lihat Kamar</a>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>