<?php 
    /**
     * Memanggil file file yang di perlukan
     */
    
    require_once '../db/Order.php';

    $order = new Order();

    $data = $order->read()->fetchAll(PDO::FETCH_ASSOC);
     
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
                                <th>Atas Nama</th>
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
                                <td><?= $row['nama_costumer'] ?></td>
                                <td><?=date('d F Y', strtotime($row['check_in']))?></td>
                                <td><?=date('d F Y', strtotime($row['check_out']))?></td>
                                <td>
                                    <?php if($row['status_trans']=='pending'){ ?>
                                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                                    <?php }elseif($row['status_trans']=='check_in'){ ?>
                                        <span class="badge badge-primary">Sedang Berlangsung</span>
                                    <?php }elseif($row['status_trans']=='check_out'){ ?>
                                        <span class="badge badge-success">Selesai Cek Out</span>
                                    <?php }elseif($row['status_trans']=='cancel'){ ?>
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    <?php }elseif($row['status_trans']=='waiting'){ ?>
                                        <span class="badge badge-info">Telah di bayar</span>
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
                            <img src="../assets/transaksi.svg" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Tagihan Pembayaran</h5>
                            <h2 class="text-primary" id="no_inv">ID</h2>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <h6>Detail Pemesanan</h6>
                            <table class="table">
                                <tr>
                                    <td>Atas Nama</td>
                                    <td id="atas_nama"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek In</td>
                                    <td id="cek_in"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cek Out</td>
                                    <td id="cek_out">/td>
                                </tr>
                            </table>
                            <hr style="margin-top:10px;margin-bottom:10px"/>
                            <div class="text-right">
                                <p id="jml_mlm"></p>
                                <h3 class="text-primary" id="total_harga">Rp. </h3>
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
                    $('#no_inv').html(response.id_trans);
                    $('#cek_in').html(response.check_in);
                    $('#atas_nama').html(response.nama_costumer);
                    $('#cek_out').html(response.check_out);
                    $('#jml_mlm').html(response.jml_malam);
                    $('#total_harga').html("Rp. "+response.total);
                    if(response.status_trans != 'pending'){
                        $('#konfirmasi').slideUp();
                    }else{
                        $('#konfirmasi').slideDown();
                    }
                    $('#btnConfirm').attr("onclick", "konfirmasi('"+response.id_trans+"')");
                    $('#btnCancel').fadeIn();
                    $('#detail-section').fadeIn();
                }
            });
        }
    </script>
</div>
