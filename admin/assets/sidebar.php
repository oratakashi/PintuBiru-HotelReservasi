<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Pintu<span class="text-info">Biru</span></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown <?php if(empty($_GET['page'])){echo "active";}?> ">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li class=<?php if(empty($_GET['page'])){echo "active";}?>><a class="nav-link" href="index.html">Dashboard</a></li>
            </ul>
            </li>
            <li class="menu-header">Administrator Menu</li>
            <li class="dropdown <?php if($_GET['page']=='administrator'||$_GET['page']=='costumer'){echo "active";}?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Kelola Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if($_GET['page']=='administrator'){echo "active";}?>"><a class="nav-link" href="administrator.html">Kelola Administrator</a></li>
                    <li><a class="nav-link" href="customer.html">Kelola Costumer</a></li>
                </ul>
            </li>
            <li class="dropdown <?php if($_GET['page']=='kamar'||$_GET['page']=='food'){echo "active";}?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Kelola Fasilitas</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if($_GET['page']=='kamar'){echo "active";}?>"><a class="nav-link" href="kamar.html">Kelola Kamar</a></li>
                    <li class="<?php if($_GET['page']=='food'){echo "active";}?>"><a class="nav-link" href="food.html">Kelola Menu Restaurant</a></li>
                </ul>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-check"></i> <span>Lihat Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Transaksi Sewa Kamar</a></li>
                    <li><a href="auth-forgot-password.html">Transaksi Restaurant</a></li>
                </ul>
            </li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://facebook.com/keisya.annajma" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-question-circle"></i> Bantuan
            </a>
        </div>        
    </aside>
</div>