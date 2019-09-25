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
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        Template update is available now!
                        <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                        <i class="far fa-user"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                        <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">
                        <i class="fas fa-check"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                        <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                        <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        Low disk space. Let's clean it!
                        <div class="time">17 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                        <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                        Welcome to Stisla template!
                        <div class="time">Yesterday</div>
                        </div>
                    </a>
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
                <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.html" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            </li>
        </ul>
    <?php } ?>
</nav>