<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Aplikasi E-Sensus Penduduk Desa Malimpung</title>

    <!-- Favicons -->
    <link href="<?= base_url('/assets/images/logo.png') ?>" rel="icon">

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('/assets/css/font-face.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/font-awesome-4.7/css/font-awesome.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/font-awesome-5/css/fontawesome-all.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/mdi-font/css/material-design-iconic-font.min.css') ?>" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('/assets/vendor/bootstrap-4.1/bootstrap.min.css') ?>" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= base_url('/assets/vendor/animsition/animsition.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet" media="all">
    <!-- <link href="<?= base_url('/assets/vendor/wow/animate.css') ?>" rel="stylesheet" media="all"> -->
    <link href="<?= base_url('/assets/vendor/css-hamburgers/hamburgers.min.css') ?>" rel="stylesheet" media="all">
    <!-- <link href="<?= base_url('/assets/vendor/slick/slick.css') ?>" rel="stylesheet" media="all"> -->


    <!-- Main CSS-->
    <link href="<?= base_url('/assets/css/theme.css') ?>" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="<?= base_url('kepala') ?>">
                            <img src="<?= base_url('/assets/images/logo.png') ?>" width="50px" alt="Sensus" />
                            E-Sensus Penduduk
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="<?= $this->Model->getPage('kepala') ?>">
                                <a href="<?= base_url("kepala/") ?>">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                            </li>
                            <li class="<?= $this->Model->getPage('laporan') ?>">
                                <a href="<?= base_url("kepala/laporan/") ?>">
                                    <i class="fas fa-book"></i>
                                    <span class="bot-line"></span>Laporan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="content">
                                    <a class="js-acc-btn" href="#">kepala desa</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__footer">
                                        <a href="<?= base_url('logout') ?>">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="<?= base_url('kepala') ?>">
                            <img src="<?= base_url('/assets/images/logo.png') ?>" width="40px" alt="Sensus" />
                            E-Sensus Penduduk
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="<?= base_url("kepala/") ?>">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                                <span class="bot-line"></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("kepala/geolokasi/") ?>">
                                <i class="fas fa-globe"></i>
                                <span class="bot-line"></span>Geolokasi</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-users"></i>
                                <span class="bot-line"></span>Penduduk</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?= base_url("kepala/penduduk/") ?>">Data Penduduk</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("kepala/kk/") ?>">Data KK</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("kepala/kelahiran/") ?>">Data Kelahiran</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("kepala/kematian/") ?>">Data Kematian</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-truck"></i>
                                <span class="bot-line"></span>Migrasi</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?= base_url("kepala/pendatang/") ?>">Data Pendatang</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("kepala/pindah/") ?>">Data Pindah</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= base_url("kepala/laporan/") ?>">
                                <i class="fas fa-book"></i>
                                <span class="bot-line"></span>Laporan</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="content">
                            <a class="js-acc-btn" href="#">kepala desa</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="account-dropdown__footer">
                                <a href="<?= base_url('logout') ?>">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->