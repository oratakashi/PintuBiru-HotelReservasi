<?php 
    require '../db/Order.php';

    $order = new Order();
    $data = $order->read_limit()->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                <div class="card-header">
                    <h4>Transaksi Terbaru</h4>
                </div>
                <div class="card-body">             
                    <ul class="list-unstyled list-unstyled-border">
                        <?php 
                            foreach($data as $row){
                        ?>
                            <li class="media">
                                <div class="media-body">
                                    <div class="float-right text-primary">
                                        <?php 
                                            if($row['selisih_tgl']==0){
                                                echo "Hari ini";
                                            }elseif($row['selisih_tgl']==1){
                                                echo "Kemarin";
                                            }else{
                                                echo $row['selisih_tgl']." Hari yang lalu";
                                            }
                                        ?>
                                    </div>
                                    <div class="media-title"><?= $row['nama_room'] ?> ( <span class="text-primary"><?= $row['id_trans'] ?></span> )</div>
                                    <span class="text-small text-muted">
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
                                    </span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="text-center pt-1 pb-1">
                    <a href="#" class="btn btn-primary btn-lg btn-round">
                        View All
                    </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>