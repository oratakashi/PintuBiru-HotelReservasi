<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="index.html" class="navbar-brand sidebar-gone-hide">Pintu<span class="text-info">Biru</span></a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
        <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">
            <?php 
                $booking_status = "";
                if($_GET['page']=='booking'||$_GET['page']=='detail'||$_GET['page']=='order'){
                    $booking_status = "active";
                }
            ?>
            <li class="nav-item <?= $booking_status ?>"><a href="booking.html" class="nav-link">Reservasi Hotel</a></li>
        </ul>
    </div>
    <div class="ml-auto"></div>
    <?php if(empty($_SESSION['id_costumer'])){ ?>
        <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="login.html" class="nav-link nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Login / Register</div></a>
        </li>
        </ul>
    <?php }else{ ?>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">Lihat Status Transaksi</a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Transaksi
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <?php 
                        require_once 'db/Order.php';

                        $order = new Order(); 

                        $data = $order->read_user_limit($_SESSION['id_costumer'])->fetchAll(PDO::FETCH_ASSOC);

                        foreach($data as $row){
                    ?>
                        <a href="#" class="dropdown-item <?php if($row['status_trans']=='pending'){echo "dropdown-item-unread";} ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    Kamar <?= $row['nama_room'] ?>
                                    <div class="time text-primary">
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
                                </div>
                                <div class="col-md-4">
                                    <?php if($row['status_trans']=='pending'){ ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php }elseif($row['status_trans']=='waiting'){ ?>
                                        <span class="badge badge-info">Menunggu</span>
                                    <?php }elseif($row['status_trans']=='check_in'){ ?>
                                        <span class="badge badge-primary">Berlangsung</span>
                                    <?php }elseif($row['status_trans']=='check_out'){ ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php }elseif($row['status_trans']=='cancel'){ ?>
                                        <span class="badge badge-danger">Batal</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="transaksi.html">Lihat yang lain <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['nama'] ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"><?= $_SESSION['email'] ?></div>
                <div class="dropdown-divider"></div>
                <a href="logout.html" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            </li>
        </ul>
    <?php } ?>
</nav>