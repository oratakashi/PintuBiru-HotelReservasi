<?php 
    /**
     * Memanggil file file yang di perlukan
     */
    
    require 'db/Order.php';

    $order = new Order();

    $data = $order->read_user($_SESSION['id_costumer'])->fetchAll(PDO::FETCH_ASSOC);
     
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Transaksi</h4> 
                    <button class="btn btn-danger" id="btnCancel">Kembali</button>                   
                </div>
                <div class="card-body" id="table-section">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Tgl Cek In</th>
                                <th>Tgl Cek Out</th>
                                <th>Status</th>
                                <th>Terakhir diperbarui</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?= $row['id_trans'] ?></td>
                                <td><?=date('d F Y', strtotime($row['check_in']))?></td>
                                <td><?=date('d F Y', strtotime($row['check_out']))?></td>
                                <td>
                                    <?php if($row['status']=='pending'){ ?>
                                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                                    <?php }elseif($row['status']=='check_in'){ ?>
                                        <span class="badge badge-primary">Sedang Berlangsung</span>
                                    <?php }elseif($row['status']=='check_out'){ ?>
                                        <span class="badge badge-success">Selesai Cek Out</span>
                                    <?php }elseif($row['status']=='cancel'){ ?>
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php 
                                        if($row['selisih_tgl']==0){
                                            echo "Hari ini";
                                        }elseif($row['selisih_tgl']==1){
                                            echo "Kemarin";
                                        }else{
                                            echo $row['selisih_tgl']." Hari yang lalu";
                                        }
                                    ?>
                                </td>
                                <td><button class="btn btn-primary" onclick="lihat_detail('<?= $row['id_trans'] ?>')"><i class="fas fa-info-circle"></i> Lihat Detail</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                </div>
                <div class="card-body" id="detail-section">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/transaksi.svg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Tagihan Pembayaran</h5>
                            <h2 class="text-primary">ID</h2>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <h6>Detail Pemesanan</h6>
                            <table class="table">
                                <tr>
                                    <td>Atas Nama</td>
                                    <td><?= $_SESSION['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Kamar</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Harga Permalam</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek In</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek Out</td>
                                    <td>/td>
                                </tr>
                            </table>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <div class="text-right">
                                <p></p>
                                <h3 class="text-primary">Rp. </h3>
                            </div>
                            <div id="konfirmasi">
                                <hr style="margin-top:10px;margin-bottom:10px"/>
                                <button onclick="" id="btnConfirm" class="btn btn-primary float-right">Konfirmasi Pembayaran</button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('#detail-section').fadeOut();
            $('#btnCancel').fadeOut();
            $('#btnCancel').click(function (e) { 
                e.preventDefault();
                $('#btnCancel').fadeOut();
                $('#table-section').fadeIn();
                $('#detail-section').fadeOut();
            });
        });
        function lihat_detail(id) { 
            $('#table-section').fadeOut();
            $.ajax({
                type: "get",
                url: "api/detail/transaksi/"+id,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('#btnCancel').fadeIn();
                    $('#detail-section').fadeIn();
                }
            });
        }
    </script>
</div>