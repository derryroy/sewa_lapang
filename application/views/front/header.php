<div class="container d-flex align-items-center justify-content-between">
    <h1 class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/img/logo.png"><span> ARENA</span></a></h1>
    <nav id="navbar" class="navbar" style="top:15px;">
        <ul>
            <li><a class="nav-link scrollto <?php echo $page_name == 'home' ? 'active' : ''; ?>" href="<?php echo $page_name == 'home' ? '#hero' : base_url(); ?>">Beranda</a></li>
            <li><a class="nav-link scrollto" href="<?php echo base_url(); ?>?page=#booking">Pemesanan</a></li>
            <li><a class="nav-link scrollto" href="<?php echo base_url(); ?>?page=#contact">Kontak</a></li>
            <li><a class="nav-link scrollto" href="<?php echo base_url(); ?>information">FAQ</a></li>

            <?php if ($this->session->userdata('user_login') == 'yes') { ?>
                <li><a class=" nav-link scrollto cart <?php echo $page_name == 'keranjang' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>keranjang"><span class="price"><i class="fas fa-shopping-cart fs-6"></i></span><span class="price_mobile"><i class="fas fa-shopping-cart fs-6"></i> Keranjang</span></a></li>
                <li class="dropdown">
                    <?php $active = '';
                    if ($page_name == 'profile' || $page_name == 'orders') {
                        $active = 'class="active"';
                    } ?>
                    <a href="javascript:;" <?php echo $active; ?>>
                        <div class="d-none d-lg-block"><i class="fas fa-user fs-5"></i>&nbsp;<i class="bi bi-chevron-down"></i></div>
                        <div class="d-lg-none"><i class="fas fa-user fs-5"></i>&nbsp;<?php echo $this->session->userdata('user_name'); ?><i class="bi bi-chevron-down"></i></div>
                    </a>
                    <ul style="left:0px;">
                        <li class="d-none d-lg-block"><a href="javascript:;"><?php echo $this->session->userdata('user_name'); ?></a>
                            <hr style="margin:0px;">
                        </li>
                        <li><a href="<?php echo base_url(); ?>profile">Profil</a></li>
                        <li><a href="<?php echo base_url(); ?>orders">Pesanan</a></li>
                        <li><a href="<?php echo base_url(); ?>user/logout">Keluar</a></li>
                    </ul>
                </li>
            <?php } elseif ($page_name != 'login' && $page_name != 'register') { ?>
                <li><a class="nav-link scrollto" href="javascript:;" data-bs-toggle="modal" data-bs-target="#login">Masuk</a></li>
            <?php } ?>
        </ul>
        <i class=" bi bi-list mobile-nav-toggle"></i>
    </nav>
</div>